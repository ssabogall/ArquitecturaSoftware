<?php

/**
 * ImageController
 * 
 * Controller for image management.
 * 
 * @author Alejandro Carmona
 */

namespace App\Http\Controllers;

use App\Interfaces\ImageStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageController extends Controller
{
    private ImageStorage $imageStorage;

    public function __construct(ImageStorage $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }

    public function index(): View
    {
        return view('image.index');
    }

    public function save(Request $request): RedirectResponse
    {
        $imageUrl = $this->imageStorage->store($request);
        
        if ($imageUrl) {
            return back()->with('success', 'Image saved successfully: ' . $imageUrl);
        }
        
        return back()->with('error', 'The image could not be saved.');
    }
}