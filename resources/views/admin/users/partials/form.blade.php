{{--
  View: Admin Users Form Partial
  Purpose: Parcial de formulario para crear/editar usuarios en admin.

  @author Alejandro Carmona
--}}
@php /* Eliminado uso de PHP crudo. Usaremos comprobaciones inline. */ @endphp

<div class="mb-3">
  <label for="name" class="form-label">{{ __('messages.name') }}</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($user) && $user && $user->exists ? $user->getName() : '') }}" required>
  @error('name')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="email" class="form-label">{{ __('messages.email') }}</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($user) && $user && $user->exists ? $user->getEmail() : '') }}" required>
  @error('email')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="password" class="form-label">{{ __('messages.password') }}</label>
    <input type="password" class="form-control" id="password" name="password" @if(!(isset($user) && $user && $user->exists)) required @endif>
    @if(isset($user) && $user && $user->exists)
    <div class="form-text">{{ __('messages.update') }}: {{ __('messages.password') }} ({{ __('messages.optional') }})</div>
  @endif
  @error('password')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3 form-check">
  <input type="hidden" name="staff" value="0">
    <input class="form-check-input" type="checkbox" value="1" id="staff" name="staff" {{ old('staff', isset($user) && $user && $user->exists ? $user->isStaff() : false) ? 'checked' : '' }}>
  <label class="form-check-label" for="staff">
    {{ __('messages.staff') }}
  </label>
</div>

<div class="mb-3">
  <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', isset($user) && $user && $user->exists ? $user->getPhone() : '') }}">
  @error('phone')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="address" class="form-label">{{ __('messages.address') }}</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', isset($user) && $user && $user->exists ? $user->getAddress() : '') }}">
  @error('address')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>