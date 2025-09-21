<?php

/**
 * Admin/MobilePhoneController.php
 *
 * Controlador para los productos en el panel de administración.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 * 
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobilePhone;
use App\Models\Specification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MobilePhoneController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = MobilePhone::orderBy('id', 'desc')->paginate(50);
        return view('admin.products.index', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['product'] = new MobilePhone();
        return view('admin.products.create', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        $photoUrl = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $brand = $request->input('brand', 'generic');
            $brandSlug = Str::slug($brand);
            $dir = public_path('images/' . $brandSlug);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $original = $request->file('photo')->getClientOriginalName();
            $ext = pathinfo($original, PATHINFO_EXTENSION) ?: 'png';
            $base = pathinfo($original, PATHINFO_FILENAME);
            $filename = Str::slug($base) . '-' . time() . '.' . strtolower($ext);
            $request->file('photo')->move($dir, $filename);
            $relative = '/images/' . $brandSlug . '/' . $filename;
            $photoUrl = url($relative);
            $request->merge(['photo_url' => $photoUrl]);
        }

        MobilePhone::validate($request);

        $product = new MobilePhone();
        $product->setName((string) $request->input('name'));
        $product->setBrand((string) $request->input('brand'));
        $product->setPrice((int) $request->input('price'));
        $product->setStock((int) $request->input('stock'));
        $product->setPhotoUrl($photoUrl);
        $product->save();

        return redirect()->route('admin.products.index')->with([
            'flash.message_key' => 'messages.product_created',
            'flash.level' => 'success',
        ]);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['product'] = MobilePhone::findOrFail($id);
        return view('admin.products.show', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['product'] = MobilePhone::findOrFail($id);
        return view('admin.products.edit', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $product = MobilePhone::findOrFail($id);
        $photoUrl = $product->getPhotoUrl();
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $brand = $request->input('brand', $product->getBrand());
            $brandSlug = Str::slug($brand);
            $dir = public_path('images/' . $brandSlug);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $original = $request->file('photo')->getClientOriginalName();
            $ext = pathinfo($original, PATHINFO_EXTENSION) ?: 'png';
            $base = pathinfo($original, PATHINFO_FILENAME);
            $filename = Str::slug($base) . '-' . time() . '.' . strtolower($ext);
            $request->file('photo')->move($dir, $filename);
            $relative = '/images/' . $brandSlug . '/' . $filename;
            $photoUrl = url($relative);
        }

        $request->merge(['photo_url' => $photoUrl]);
        MobilePhone::validate($request);
        $product->setName((string) $request->input('name'));
        $product->setBrand((string) $request->input('brand'));
        $product->setPrice((int) $request->input('price'));
        $product->setStock((int) $request->input('stock'));
        $product->setPhotoUrl($photoUrl);
        $product->save();

        return redirect()->route('admin.products.index')->with([
            'flash.message_key' => 'messages.product_updated',
            'flash.level' => 'success',
        ]);
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = MobilePhone::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'flash.message_key' => 'messages.product_deleted',
            'flash.level' => 'success',
        ]);
    }
}
