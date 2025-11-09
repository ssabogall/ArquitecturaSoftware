<?php

/**
 * LocaleController
 *  
 * Set the application locale and redirect back.
 * 
 * @author Miguel Arcila
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LocaleController extends BaseController
{
    public function setLocale(Request $request, string $locale)
    {
        $allowed = ['es', 'en'];
        if (! in_array($locale, $allowed)) {
            $locale = config('app.locale');
        }

        $request->session()->put('app_locale', $locale);

        return redirect()->back();
    }
}
