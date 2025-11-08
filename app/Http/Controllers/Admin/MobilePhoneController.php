<?php

/**
 * Admin/MobilePhoneController.php
 *
 * Controlador para los productos en el panel de administración.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobilePhone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MobilePhoneController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['mobilePhones'] = MobilePhone::orderBy('id', 'desc')->paginate(50);

        return view('admin.mobilePhones.index', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['mobilePhone'] = new MobilePhone;

        return view('admin.mobilePhones.create', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        $photoUrl = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $brand = $request->input('brand', 'generic');
            $brandSlug = Str::slug($brand);
            $dir = public_path('images/'.$brandSlug);
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $original = $request->file('photo')->getClientOriginalName();
            $ext = pathinfo($original, PATHINFO_EXTENSION) ?: 'png';
            $base = pathinfo($original, PATHINFO_FILENAME);
            $filename = Str::slug($base).'-'.time().'.'.strtolower($ext);
            $request->file('photo')->move($dir, $filename);
            $relative = '/images/'.$brandSlug.'/'.$filename;
            $photoUrl = url($relative);
            $request->merge(['photo_url' => $photoUrl]);
        }

        MobilePhone::validate($request);

        $mobilePhone = new MobilePhone;
        $mobilePhone->setName((string) $request->input('name'));
        $mobilePhone->setBrand((string) $request->input('brand'));
        $mobilePhone->setPrice((int) $request->input('price'));
        $mobilePhone->setStock((int) $request->input('stock'));
        $mobilePhone->setPhotoUrl($photoUrl);
        $mobilePhone->save();

        return redirect()->route('admin.mobilePhones.index')->with([
            'flash.message_key' => 'messages.product_created',
            'flash.level' => 'success',
        ]);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['mobilePhone'] = MobilePhone::findOrFail($id);

        return view('admin.mobilePhones.show', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['mobilePhone'] = MobilePhone::findOrFail($id);

        return view('admin.mobilePhones.edit', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $mobilePhone = MobilePhone::findOrFail($id);
        $photoUrl = $mobilePhone->getPhotoUrl();
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $brand = $request->input('brand', $mobilePhone->getBrand());
            $brandSlug = Str::slug($brand);
            $dir = public_path('images/'.$brandSlug);
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $original = $request->file('photo')->getClientOriginalName();
            $ext = pathinfo($original, PATHINFO_EXTENSION) ?: 'png';
            $base = pathinfo($original, PATHINFO_FILENAME);
            $filename = Str::slug($base).'-'.time().'.'.strtolower($ext);
            $request->file('photo')->move($dir, $filename);
            $relative = '/images/'.$brandSlug.'/'.$filename;
            $photoUrl = url($relative);
        }

        $request->merge(['photo_url' => $photoUrl]);
        MobilePhone::validate($request);
        $mobilePhone->setName((string) $request->input('name'));
        $mobilePhone->setBrand((string) $request->input('brand'));
        $mobilePhone->setPrice((int) $request->input('price'));
        $mobilePhone->setStock((int) $request->input('stock'));
        $mobilePhone->setPhotoUrl($photoUrl);
        $mobilePhone->save();

        return redirect()->route('admin.mobilePhones.index')->with([
            'flash.message_key' => 'messages.product_updated',
            'flash.level' => 'success',
        ]);
    }

    public function destroy(string $id): RedirectResponse
    {
        $mobilePhone = MobilePhone::findOrFail($id);
        $mobilePhone->delete();

        return redirect()->route('admin.mobilePhones.index')->with([
            'flash.message_key' => 'messages.product_deleted',
            'flash.level' => 'success',
        ]);
    }
}
