<?php

/**
 * HomeController.php
 *
 * Controller for the home page.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        $topPhones = MobilePhone::query()
            ->withAvg(['reviews as approved_reviews_avg_rating' => function (Builder $query): void {
                $query->where('status', 'approved');
            }], 'rating')
            ->withCount(['reviews as approved_reviews_count' => function (Builder $query): void {
                $query->where('status', 'approved');
            }])
            ->orderByDesc('approved_reviews_avg_rating')
            ->orderByDesc('approved_reviews_count')
            ->limit(3)
            ->get();

        $viewData['topPhones'] = $topPhones;

        return view('home.index')->with('viewData', $viewData);
    }
}
