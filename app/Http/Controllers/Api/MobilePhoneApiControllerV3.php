<?php

/**
 * MobilePhoneApiControllerV3.php
 *
 * API Controller (version 3) for listing mobile phones.
 * Uses Laravel Resource Collections for structured JSON responses.
 *
 * @author Santiago Sabogal
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MobilePhoneCollection;
use App\Models\MobilePhone;
use Illuminate\Http\JsonResponse;

class MobilePhoneApiControllerV3 extends Controller
{
    /**
     * Returns all mobile phones without pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $phones = new MobilePhoneCollection(MobilePhone::all());
        return response()->json($phones, 200);
    }

    /**
     * Returns paginated list of mobile phones.
     *
     * @return JsonResponse
     */
    public function paginate(): JsonResponse
    {
        $phones = new MobilePhoneCollection(MobilePhone::paginate(5));
        return response()->json($phones, 200);
    }
}
