<?php

/**
 * Admin/UserController.php
 *
 * Controller for users in the administration panel.
 *
 * @author Alejandro Carmona
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['users'] = User::orderBy('id', 'desc')->paginate(50);

        return view('admin.users.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['user'] = new User;

        return view('admin.users.create')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = User::validate($request->all())->validate();

        $user = new User;
        $user->setName($validatedData['name']);
        $user->setEmail($validatedData['email']);
        $user->setPassword(Hash::make($validatedData['password']));
        $user->setBalance((float) ($validatedData['balance'] ?? 0));
        $user->setStaff((bool) ($validatedData['staff'] ?? false));
        $user->setPhone($validatedData['phone'] ?? null);
        $user->setAddress($validatedData['address'] ?? null);
        $user->save();

        return redirect()->route('admin.users.index')
            ->with([
                'flash.message_key' => 'messages.user_created',
                'flash.level' => 'success',
            ]);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['user'] = User::findOrFail($id);

        return view('admin.users.show')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['user'] = User::findOrFail($id);

        return view('admin.users.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $validatedData = User::validate($request->all(), (int) $user->id)->validate();

        $user->setName($validatedData['name']);
        $user->setEmail($validatedData['email']);
        if (! empty($validatedData['password'])) {
            $user->setPassword(Hash::make($validatedData['password']));
        }
        if (array_key_exists('balance', $validatedData)) {
            $user->setBalance((float) $validatedData['balance']);
        }
        if (array_key_exists('staff', $validatedData)) {
            $user->setStaff((bool) $validatedData['staff']);
        }
        $user->setPhone($validatedData['phone'] ?? null);
        $user->setAddress($validatedData['address'] ?? null);
        $user->save();

        return redirect()->route('admin.users.index')
            ->with([
                'flash.message_key' => 'messages.user_updated',
                'flash.level' => 'success',
            ]);
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with([
                'flash.message_key' => 'messages.user_deleted',
                'flash.level' => 'success',
            ]);
    }
}
