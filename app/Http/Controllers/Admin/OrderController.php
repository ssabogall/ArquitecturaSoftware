<?php

/**
 * Admin/OrderController.php
 *
 * Controller for managing orders in the administration panel.
 *
 * @author Alejandro Carmona
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::with(['user', 'items.mobilePhone'])
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('admin.orders.index')->with('viewData', $viewData);
    }
}
