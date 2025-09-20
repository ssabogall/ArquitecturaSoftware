@php
  /** @var \App\Models\User $user */
  $isEdit = $user && $user->exists;
@endphp

<div class="mb-3">
  <label for="name" class="form-label">{{ __('messages.name') }}</label>
  <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
  @error('name')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="email" class="form-label">{{ __('messages.email') }}</label>
  <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
  @error('email')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="password" class="form-label">{{ __('messages.password') }}</label>
  <input type="password" class="form-control" id="password" name="password" @if(!$isEdit) required @endif>
  @if($isEdit)
    <div class="form-text">{{ __('messages.update') }}: {{ __('messages.password') }} ({{ __('messages.optional') ?? 'Opcional' }})</div>
  @endif
  @error('password')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3 form-check">
  <input type="hidden" name="staff" value="0">
  <input class="form-check-input" type="checkbox" value="1" id="staff" name="staff" {{ old('staff', $user->staff ?? false) ? 'checked' : '' }}>
  <label class="form-check-label" for="staff">
    {{ __('messages.staff') }}
  </label>
</div>

<div class="mb-3">
  <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
  <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
  @error('phone')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="address" class="form-label">{{ __('messages.address') }}</label>
  <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address ?? '') }}">
  @error('address')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>