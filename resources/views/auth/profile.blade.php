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
                @if (session('flash.message'))
                    <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                        {{ session('flash.message') }}
                    </div>
                @elseif (session('flash.message_key'))
                    <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                        {{ __(session('flash.message_key')) }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $viewData['user']->getName()) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.balance') }}</label>
                        <div class="form-control-plaintext fw-bold text-success">
                            {{ __('messages.currency_symbol') }}{{ number_format($viewData['user']->getBalance(), 0, ',', '.') }}
                        </div>
                        <small class="text-muted">{{ __('messages.balance') }} disponible para compras</small>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('messages.phone') }} ({{ __('messages.optional') }})</label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $viewData['user']->getPhone()) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('messages.address') }} ({{ __('messages.optional') }})</label>
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $viewData['user']->getAddress()) }}">
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
