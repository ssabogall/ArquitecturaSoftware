<?php

/**
 * AccountController.php
 *
 * Controlador para el perfil del usuario.
 *
 * @author Miguel Arcila
 *
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function show(): View
    {
        $viewData = [];
        $viewData['user'] = Auth::user();
        return view('auth.profile', $viewData);
    }

    public function update(Request $request): RedirectResponse
    {
        User::validateProfile($request);

        $user = Auth::user();
        $user->setName((string) $request->input('name'));
        $user->setPhone($request->input('phone'));
        $user->setAddress($request->input('address'));
        $user->save();

        return redirect()->route('profile.show')->with([
            'flash.message_key' => 'messages.profile_updated',
            'flash.level' => 'success',
        ]);
    }
}
