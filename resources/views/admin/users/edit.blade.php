{{--
  View: Admin Users Edit
  Purpose: Muestra el formulario para editar un usuario en admin.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.edit_user'))
@section('header', __('messages.edit_user'))

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.users.update', ['user' => $viewData['user']->getId()]) }}" method="POST">
      @csrf
      @method('PUT')
      
      <div class="mb-3">
        <label for="name" class="form-label">{{ __('messages.name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $viewData['user']->getName()) }}" required>
        @error('name')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">{{ __('messages.email') }}</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $viewData['user']->getEmail()) }}" required>
        @error('email')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">{{ __('messages.password') }}</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="form-text">{{ __('messages.update') }}: {{ __('messages.password') }} ({{ __('messages.optional') }})</div>
        @error('password')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 form-check">
        <input type="hidden" name="staff" value="0">
        <input class="form-check-input" type="checkbox" value="1" id="staff" name="staff" {{ old('staff', $viewData['user']->isStaff()) ? 'checked' : '' }}>
        <label class="form-check-label" for="staff">
          {{ __('messages.staff') }}
        </label>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $viewData['user']->getPhone()) }}">
        @error('phone')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">{{ __('messages.address') }}</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $viewData['user']->getAddress()) }}">
        @error('address')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection