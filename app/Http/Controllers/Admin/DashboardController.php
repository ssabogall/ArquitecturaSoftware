<?php

/**
 * Admin/DashboardController.php
 *
 * Controller for managing the administration panel.
 *
 * @author Alejandro Carmona
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobilePhone;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        $viewData['activeUsersCount'] = User::count();
        $viewData['productsCount'] = MobilePhone::count();

        $viewData['ordersByStatus'] = [
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $viewData['pendingReviewsCount'] = Review::where('status', 'pending')->count();

        return view('admin.dashboard')->with('viewData', $viewData);
    }
}
