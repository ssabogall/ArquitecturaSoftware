<?php

/**
 * PartnerProductController.php
 *
 * Controller for displaying partner products.
 * Shows products from INSUMAX partner API.
 *
 * @author Alejandro Carmona
 */

namespace App\Http\Controllers;

class PartnerProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = __('messages.partner_products');

        return view('partners.index')->with('viewData', $viewData);
    }
}
