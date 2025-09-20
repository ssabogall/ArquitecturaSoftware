<?php

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
        $users = User::orderBy('id', 'desc')->paginate(50);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'user' => new User,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = User::validate($request->all())->validate();

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->staff = (bool) ($validated['staff'] ?? false);
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->save();

        return redirect()->route('admin.users.index')
            ->with([
                'flash.message_key' => 'messages.user_created',
                'flash.level' => 'success',
            ]);
    }

    public function show(string $id): View
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', ['user' => $user]);
    }

    public function edit(string $id): View
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $validated = User::validate($request->all(), (int) $user->id)->validate();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        if (array_key_exists('staff', $validated)) {
            $user->staff = (bool) $validated['staff'];
        }
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;
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
