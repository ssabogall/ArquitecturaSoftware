<?php

/**
 * MobilePhoneController.php
 *
 * Controlador para los teléfonos móviles.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobilePhoneController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $phonesQuery = MobilePhone::with('specification')
            ->where('stock', '>', 0);

        if ($q !== '') {
            $phonesQuery->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('brand', 'like', "%$q%");
            });
        }

        $phones = $phonesQuery
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $viewData = [
            'phones' => $phones,
            'q' => $q,
        ];

        return view('phones.index', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['phone'] = MobilePhone::with(['specification', 'reviews' => function ($q) {
            $q->where('status', 'approved')->latest();
        }])->findOrFail($id);

        $approved = $viewData['phone']->reviews;
        $count = $approved->count();
        $average = $count > 0 ? round($approved->avg(function ($r) {
            return $r->getRating();
        }), 1) : null;

        $viewData['reviewsAvg'] = $average;
        $viewData['reviewsCount'] = $count;

        return view('phones.show', $viewData);
    }

    public function submitReview(Request $request, int $id): RedirectResponse
    {

        $request->merge([
            'user_id' => Auth::id(),
            'mobile_phone_id' => $id,
            'status' => 'pending',
        ]);

        Review::validate($request);

        $review = new Review;
        $review->setUserId(Auth::id());
        $review->setMobilePhoneId($id);
        $review->setStatus('pending');
        $review->setRating((int) $request->input('rating'));
        $review->setComments($request->input('comments'));
        $review->save();

        session()->flash('flash.message_key', 'messages.review_submitted_pending');
        session()->flash('flash.level', 'info');

        return redirect()->route('phones.show', ['id' => $id]);
    }
}
