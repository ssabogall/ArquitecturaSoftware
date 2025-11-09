{{--
    View: Admin Specifications Edit
    Purpose: Edit an existing Specification.

    @author Miguel Arcila
--}}
@extends('layouts.admin')

@section('title', __('messages.edit_spec'))
@section('header', __('messages.edit_spec'))

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.specifications.update', ['specification' => $viewData['spec']->getId()]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="mobile_phone_id" class="form-label">{{ __('messages.products') }}</label>
                <select id="mobile_phone_id" name="mobile_phone_id" class="form-select" required>
                    <option value="">-- {{ __('messages.select') }} --</option>
                    @foreach($viewData['mobilePhones'] as $mobilePhone)
                        <option value="{{ $mobilePhone->getId() }}" @selected((string)old('mobile_phone_id', $viewData['spec']->getMobilePhoneId()) === (string)$mobilePhone->getId())>{{ $mobilePhone->getName() }}</option>
                    @endforeach
                </select>
                @error('mobile_phone_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">{{ __('messages.model') }}</label>
                <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $viewData['spec']->getModel()) }}" required />
                @error('model')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="processor" class="form-label">{{ __('messages.processor') }}</label>
                <input type="text" id="processor" name="processor" class="form-control" value="{{ old('processor', $viewData['spec']->getProcessor()) }}" required />
                @error('processor')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="battery" class="form-label">{{ __('messages.battery') }}</label>
                <input type="number" min="0" step="1" id="battery" name="battery" class="form-control" value="{{ old('battery', $viewData['spec']->getBattery()) }}" required />
                @error('battery')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="screen_size" class="form-label">{{ __('messages.screen_size') }}</label>
                <input type="number" min="0" step="0.1" id="screen_size" name="screen_size" class="form-control" value="{{ old('screen_size', $viewData['spec']->getScreenSize()) }}" required />
                @error('screen_size')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="screen_tech" class="form-label">{{ __('messages.screen_tech') }}</label>
                <input type="text" id="screen_tech" name="screen_tech" class="form-control" value="{{ old('screen_tech', $viewData['spec']->getScreenTech()) }}" required />
                @error('screen_tech')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ram" class="form-label">{{ __('messages.ram') }}</label>
                <input type="number" min="0" step="1" id="ram" name="ram" class="form-control" value="{{ old('ram', $viewData['spec']->getRam()) }}" required />
                @error('ram')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="storage" class="form-label">{{ __('messages.storage') }}</label>
                <input type="number" min="0" step="1" id="storage" name="storage" class="form-control" value="{{ old('storage', $viewData['spec']->getStorage()) }}" required />
                @error('storage')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="camera_specs" class="form-label">{{ __('messages.camera_specs') }}</label>
                <input type="text" id="camera_specs" name="camera_specs" class="form-control" value="{{ old('camera_specs', $viewData['spec']->getCameraSpecs()) }}" />
                @error('camera_specs')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">{{ __('messages.color') }}</label>
                <input type="text" id="color" name="color" class="form-control" value="{{ old('color', $viewData['spec']->getColor()) }}" required />
                @error('color')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">{{ __('messages.update') }}</button>
                <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
