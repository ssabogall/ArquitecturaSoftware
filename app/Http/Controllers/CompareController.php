<?php

/**
 * CompareController
 *
 * Controller for comparing mobile phones specifications.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompareController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('messages.compare_phones');
        $viewData['mobilePhones'] = MobilePhone::with('specification')->get();

        return view('compare.index')->with('viewData', $viewData);
    }

    public function show(Request $request): View
    {
        MobilePhone::validateCompare($request);

        $phoneIds = $request->input('phones');
        
        $viewData = [];
        $viewData['title'] = __('messages.phone_comparison');
        $viewData['phones'] = MobilePhone::with('specification')
            ->whereIn('id', $phoneIds)
            ->get();

        return view('compare.show')->with('viewData', $viewData);
    }
}