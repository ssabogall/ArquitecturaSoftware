{{--
    View: Admin Specifications Form
    Purpose: Parcial de formulario para crear/editar especificaciones en admin.

    @author Miguel Arcila
--}}
@php
    /** @var \App\Models\Specification $spec */
    /** @var \Illuminate\Support\Collection|\App\Models\MobilePhone[] $phones */
    $isEdit = isset($spec) && $spec && $spec->exists;
    $selectedPhoneId = old('mobile_phone_id', $isEdit ? $spec->getMobilePhoneId() : null);
@endphp

<div class="mb-3">
    <label for="mobile_phone_id" class="form-label">{{ __('messages.products') }}</label>
    <select id="mobile_phone_id" name="mobile_phone_id" class="form-select" required>
        <option value="">-- {{ __('messages.select') }} --</option>
        @foreach($phones as $p)
            <option value="{{ $p->getId() }}" @selected((string)$selectedPhoneId === (string)$p->getId())>{{ $p->getName() }}</option>
        @endforeach
    </select>
    @error('mobile_phone_id')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
    </div>

<div class="mb-3">
    <label for="model" class="form-label">{{ __('messages.model') }}</label>
    <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $isEdit ? $spec->getModel() : '') }}" required />
    @error('model')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="processor" class="form-label">{{ __('messages.processor') }}</label>
    <input type="text" id="processor" name="processor" class="form-control" value="{{ old('processor', $isEdit ? $spec->getProcessor() : '') }}" required />
    @error('processor')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="battery" class="form-label">{{ __('messages.battery') }}</label>
    <input type="number" min="0" step="1" id="battery" name="battery" class="form-control" value="{{ old('battery', $isEdit ? $spec->getBattery() : 0) }}" required />
    @error('battery')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="screen_size" class="form-label">{{ __('messages.screen_size') }}</label>
    <input type="number" min="0" step="0.1" id="screen_size" name="screen_size" class="form-control" value="{{ old('screen_size', $isEdit ? $spec->getScreenSize() : 0) }}" required />
    @error('screen_size')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="screen_tech" class="form-label">{{ __('messages.screen_tech') }}</label>
    <input type="text" id="screen_tech" name="screen_tech" class="form-control" value="{{ old('screen_tech', $isEdit ? $spec->getScreenTech() : '') }}" required />
    @error('screen_tech')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="ram" class="form-label">{{ __('messages.ram') }}</label>
    <input type="number" min="0" step="1" id="ram" name="ram" class="form-control" value="{{ old('ram', $isEdit ? $spec->getRam() : 0) }}" required />
    @error('ram')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="storage" class="form-label">{{ __('messages.storage') }}</label>
    <input type="number" min="0" step="1" id="storage" name="storage" class="form-control" value="{{ old('storage', $isEdit ? $spec->getStorage() : 0) }}" required />
    @error('storage')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="camera_specs" class="form-label">{{ __('messages.camera_specs') }}</label>
    <input type="text" id="camera_specs" name="camera_specs" class="form-control" value="{{ old('camera_specs', $isEdit ? $spec->getCameraSpecs() : '') }}" />
    @error('camera_specs')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="color" class="form-label">{{ __('messages.color') }}</label>
    <input type="text" id="color" name="color" class="form-control" value="{{ old('color', $isEdit ? $spec->getColor() : '') }}" required />
    @error('color')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
