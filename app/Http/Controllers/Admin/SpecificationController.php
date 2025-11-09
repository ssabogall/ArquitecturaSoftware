<?php

/**
 * Admin/SpecificationController.php
 *
 * Controller for managing specifications (Specification) in the administration panel.
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

        return view('admin.specifications.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['spec'] = new Specification;
        $viewData['mobilePhones'] = MobilePhone::orderBy('name')->get();

        return view('admin.specifications.create')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Specification::validate($request);

        $specification = new Specification;
        $specification->setMobilePhoneId((int) $request->input('mobile_phone_id'));
        $specification->setModel((string) $request->input('model'));
        $specification->setProcessor((string) $request->input('processor'));
        $specification->setBattery((int) $request->input('battery'));
        $specification->setScreenSize((float) $request->input('screen_size'));
        $specification->setScreenTech((string) $request->input('screen_tech'));
        $specification->setRam((int) $request->input('ram'));
        $specification->setStorage((int) $request->input('storage'));
        $specification->setCameraSpecs($request->input('camera_specs'));
        $specification->setColor((string) $request->input('color'));
        $specification->save();

        return redirect()->route('admin.specifications.index')->with([
            'flash.message_key' => 'messages.spec_created',
            'flash.level' => 'success',
        ]);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['spec'] = Specification::with('mobilePhone')->findOrFail($id);

        return view('admin.specifications.show')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['spec'] = Specification::findOrFail($id);
        $viewData['mobilePhones'] = MobilePhone::orderBy('name')->get();

        return view('admin.specifications.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $specification = Specification::findOrFail($id);
        Specification::validate($request);

        $specification->setMobilePhoneId((int) $request->input('mobile_phone_id'));
        $specification->setModel((string) $request->input('model'));
        $specification->setProcessor((string) $request->input('processor'));
        $specification->setBattery((int) $request->input('battery'));
        $specification->setScreenSize((float) $request->input('screen_size'));
        $specification->setScreenTech((string) $request->input('screen_tech'));
        $specification->setRam((int) $request->input('ram'));
        $specification->setStorage((int) $request->input('storage'));
        $specification->setCameraSpecs($request->input('camera_specs'));
        $specification->setColor((string) $request->input('color'));
        $specification->save();

        return redirect()->route('admin.specifications.index')->with([
            'flash.message_key' => 'messages.spec_updated',
            'flash.level' => 'success',
        ]);
    }

    public function destroy(string $id): RedirectResponse
    {
        $specification = Specification::findOrFail($id);
        $specification->delete();

        return redirect()->route('admin.specifications.index')->with([
            'flash.message_key' => 'messages.spec_deleted',
            'flash.level' => 'success',
        ]);
    }
}