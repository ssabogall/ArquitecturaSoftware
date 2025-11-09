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
use Illuminate\Support\Str;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): ?string
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            
            $brand = $request->input('brand', 'default');
            $brandFolder = Str::slug($brand);
            
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            
            $safeName = Str::slug($originalName);
            $filename = $safeName . '-' . time() . '.' . $extension;
            
            $directory = public_path('images/' . $brandFolder);
            
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            $file->move($directory, $filename);
            
            return 'images/' . $brandFolder . '/' . $filename;
        }

        return null;
    }
}
