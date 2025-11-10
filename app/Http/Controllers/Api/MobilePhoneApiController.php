<?php

/**
 * MobilePhoneApiController.php
 *
 * API Controller for listing mobile phones.
 * Uses Laravel Resource Collections for structured JSON responses.
 *
 * @author Santiago Sabogal
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MobilePhoneCollection;
use App\Models\MobilePhone;
use Illuminate\Http\JsonResponse;

class MobilePhoneApiController extends Controller
{
    public function index(): JsonResponse
    {
        $phones = new MobilePhoneCollection(MobilePhone::all());

        return response()->json($phones, 200);
    }

    public function paginate(): JsonResponse
    {
        $topPhones = MobilePhone::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(4)
            ->get();

        $phones = new MobilePhoneCollection($topPhones);

        return response()->json($phones, 200);
    }
}
