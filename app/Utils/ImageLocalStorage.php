<?php

/**
 * ImageLocalStorage
 * 
 * Local implementation of image storage.
 * 
 * @author Alejandro Carmona
 */

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): ?string
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            
            $path = $file->storeAs('images', $filename, 'public');
            
            return Storage::url($path);
        }
        
        return null;
    }
}