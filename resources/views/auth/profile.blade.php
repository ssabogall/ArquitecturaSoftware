{{--
    View: Perfil de Usuario
    Purpose: Permite ver y actualizar nombre, teléfono y dirección.

    @author Miguel Arcila
--}}
@extends('layouts.app')

@section('title', __('messages.my_account'))
@section('header', __('messages.my_account'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('messages.my_account') }}</div>
            <div class="card-body">
                @if (session('flash.message_key'))
                    <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                        {{ __(session('flash.message_key')) }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->getName()) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('messages.phone') }} ({{ __('messages.optional') }})</label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->getPhone()) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('messages.address') }} ({{ __('messages.optional') }})</label>
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->getAddress()) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                        <a href="{{ route('home.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
