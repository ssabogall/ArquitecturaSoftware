<?php

/**
 * Admin/ReviewController.php
 *
 * Controller for managing review approvals and rejections.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['reviews'] = Review::with(['user', 'mobilePhone'])->orderByDesc('id')->paginate(50);

        return view('admin.reviews.index')->with('viewData', $viewData);
    }

    public function approve(Review $review): RedirectResponse
    {
        if ($review->getStatus() !== 'approved') {
            $review->setStatus('approved');
            $review->save();
        }

        return redirect()->route('admin.reviews.index')->with([
            'flash.message_key' => 'messages.review_approved',
            'flash.level' => 'success',
        ]);
    }

    public function reject(Review $review): RedirectResponse
    {
        if ($review->getStatus() !== 'rejected') {
            $review->setStatus('rejected');
            $review->save();
        }

        return redirect()->route('admin.reviews.index')->with([
            'flash.message_key' => 'messages.review_rejected',
            'flash.level' => 'warning',
        ]);
    }
}
