<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        return view('home.index', $viewData);
    }
}
