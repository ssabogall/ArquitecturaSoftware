<?php

/**
 * HomeController.php
 *
 * Controlador para el home
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;

class HomeController extends Controller
{
    public function index()
    {

        $topPhones = MobilePhone::query()
            ->withAvg(['reviews as approved_reviews_avg_rating' => function ($q) {
                $q->where('status', 'approved');
            }], 'rating')
            ->withCount(['reviews as approved_reviews_count' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->orderByDesc('approved_reviews_avg_rating')
            ->orderByDesc('approved_reviews_count')
            ->limit(3)
            ->get();

        return view('home.index', [
            'topPhones' => $topPhones,
        ]);
    }
}
