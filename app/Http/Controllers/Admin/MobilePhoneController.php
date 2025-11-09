<?php

/**
 * Admin/MobilePhoneController.php
 *
 * Controller for products in the administration panel.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ImageStorage;
use App\Models\MobilePhone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MobilePhoneController extends Controller
{
    private ImageStorage $imageStorage;

    public function __construct(ImageStorage $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }
    public function index(): View
    {
        $viewData = [];
        $viewData['mobilePhones'] = MobilePhone::orderBy('id', 'desc')->paginate(50);

        return view('admin.mobilePhones.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['mobilePhone'] = new MobilePhone();
        return view('admin.mobilePhones.create')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        MobilePhone::validate($request);

        $photoUrl = $this->imageStorage->store($request);

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

        return view('admin.mobilePhones.show')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['mobilePhone'] = MobilePhone::findOrFail($id);

        return view('admin.mobilePhones.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        MobilePhone::validate($request);

        $mobilePhone = MobilePhone::findOrFail($id);

        $photoUrl = $this->imageStorage->store($request);
        if ($photoUrl) {
            $mobilePhone->setPhotoUrl($photoUrl);
        }

        $mobilePhone->setName((string) $request->input('name'));
        $mobilePhone->setBrand((string) $request->input('brand'));
        $mobilePhone->setPrice((int) $request->input('price'));
        $mobilePhone->setStock((int) $request->input('stock'));
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