<?php

/**
 * Admin/SpecificationController.php
 *
 * Controlador para gestionar especificaciones (Specification) en el panel de administración.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobilePhone;
use App\Models\Specification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpecificationController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['specs'] = Specification::with('mobilePhone')->orderByDesc('id')->paginate(50);

        return view('admin.specifications.index', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['spec'] = new Specification;
        $viewData['phones'] = MobilePhone::orderBy('name')->get();

        return view('admin.specifications.create', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Specification::validate($request);
        $spec = new Specification;
        $spec->setMobilePhoneId((int) $request->input('mobile_phone_id'));
        $spec->setModel((string) $request->input('model'));
        $spec->setProcessor((string) $request->input('processor'));
        $spec->setBattery((int) $request->input('battery'));
        $spec->setScreenSize((float) $request->input('screen_size'));
        $spec->setScreenTech((string) $request->input('screen_tech'));
        $spec->setRam((int) $request->input('ram'));
        $spec->setStorage((int) $request->input('storage'));
        $spec->setCameraSpecs($request->input('camera_specs'));
        $spec->setColor((string) $request->input('color'));
        $spec->save();

        return redirect()->route('admin.specifications.index')->with([
            'flash.message_key' => 'messages.spec_created',
            'flash.level' => 'success',
        ]);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['spec'] = Specification::with('mobilePhone')->findOrFail($id);

        return view('admin.specifications.show', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['spec'] = Specification::findOrFail($id);
        $viewData['phones'] = MobilePhone::orderBy('name')->get();

        return view('admin.specifications.edit', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $spec = Specification::findOrFail($id);
        Specification::validate($request);
        $spec->setMobilePhoneId((int) $request->input('mobile_phone_id'));
        $spec->setModel((string) $request->input('model'));
        $spec->setProcessor((string) $request->input('processor'));
        $spec->setBattery((int) $request->input('battery'));
        $spec->setScreenSize((float) $request->input('screen_size'));
        $spec->setScreenTech((string) $request->input('screen_tech'));
        $spec->setRam((int) $request->input('ram'));
        $spec->setStorage((int) $request->input('storage'));
        $spec->setCameraSpecs($request->input('camera_specs'));
        $spec->setColor((string) $request->input('color'));
        $spec->save();

        return redirect()->route('admin.specifications.index')->with([
            'flash.message_key' => 'messages.spec_updated',
            'flash.level' => 'success',
        ]);
    }

    public function destroy(string $id): RedirectResponse
    {
        $spec = Specification::findOrFail($id);
        $spec->delete();

        return redirect()->route('admin.specifications.index')->with([
            'flash.message_key' => 'messages.spec_deleted',
            'flash.level' => 'success',
        ]);
    }
}
