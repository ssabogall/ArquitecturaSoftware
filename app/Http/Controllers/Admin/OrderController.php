<?php

/**
 * Admin/OrderController.php
 *
 * Controlador para las órdenes en el panel de administración.
 *
 * @author Alejandro Carmona
 *
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        return view('admin.orders.index', $viewData);
    }
}
