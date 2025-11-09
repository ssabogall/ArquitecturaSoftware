<?php

/**
 * MobilePhoneController.php
 *
 * Controller for mobile phones.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobilePhoneController extends Controller
{
    public function index(Request $request): View
    {
        $searchQuery = trim((string) $request->query('q', ''));

        $mobilePhoneQuery = MobilePhone::with('specification')
            ->where('stock', '>', 0);

        if ($searchQuery !== '') {
            $mobilePhoneQuery->where(function (Builder $query) use ($searchQuery): void {
                $query->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('brand', 'like', "%{$searchQuery}%");
            });
        }

        $mobilePhones = $mobilePhoneQuery
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $viewData = [];
        $viewData['mobilePhones'] = $mobilePhones;
        $viewData['searchQuery'] = $searchQuery;

        return view('mobilePhones.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $viewData['mobilePhone'] = MobilePhone::with([
            'specification',
            'reviews' => function ($query): void {
                $query->where('status', 'approved')->latest();
            },
        ])->findOrFail($id);

        $approvedReviews = $viewData['mobilePhone']->getReviews();
        $reviewsCount = $approvedReviews->count();
        $reviewsAverage = $reviewsCount > 0
            ? round($approvedReviews->avg(function (Review $review): int {
                return $review->getRating();
            }), 1)
            : null;

        $viewData['reviewsAvg'] = $reviewsAverage;
        $viewData['reviewsCount'] = $reviewsCount;

        return view('mobilePhones.show')->with('viewData', $viewData);
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

        return redirect()->route('mobilePhones.show', ['id' => $id]);
    }
}