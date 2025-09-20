<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MobilePhone;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['activeUsers'] = User::count();
        $viewData['productsCount'] = MobilePhone::count();
        $viewData['ordersByStatus'] = [
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', $viewData);
    }
}
