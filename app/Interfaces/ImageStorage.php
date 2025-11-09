<?php

/**
 * ImageStorage Interface
 * 
 * Defines the contract for image storage.
 * 
 * @author Alejandro Carmona
 */

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ImageStorage
{
    public function store(Request $request): ?string;
}