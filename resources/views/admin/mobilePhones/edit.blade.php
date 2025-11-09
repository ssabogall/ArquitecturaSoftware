{{--
  View: Admin Products Edit
  Purpose: Shows the form to edit an existing product.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.edit_product'))
@section('header', __('messages.edit_product'))

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.mobilePhones.update', ['mobilePhone' => $viewData['mobilePhone']->getId()]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      
      <div class="mb-3">
        <label for="name" class="form-label">{{ __('messages.name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $viewData['mobilePhone']->getName()) }}" required>
        @error('name')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="brand" class="form-label">{{ __('messages.brand') }}</label>
        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $viewData['mobilePhone']->getBrand()) }}" required>
        @error('brand')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">{{ __('messages.price') }}</label>
        <input type="number" min="0" step="1" class="form-control" id="price" name="price" value="{{ old('price', $viewData['mobilePhone']->getPrice()) }}" required>
        @error('price')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="stock" class="form-label">{{ __('messages.stock') }}</label>
        <input type="number" min="0" step="1" class="form-control" id="stock" name="stock" value="{{ old('stock', $viewData['mobilePhone']->getStock()) }}" required>
        @error('stock')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        @if(!empty($viewData['mobilePhone']->getPhotoUrl()))
          <div class="form-text">
            {{ __('messages.current') }}: <a href="{{ $viewData['mobilePhone']->getPhotoUrl() }}" target="_blank" rel="noopener noreferrer">{{ $viewData['mobilePhone']->getPhotoFilename() }}</a>
          </div>
        @endif
        @error('photo')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('admin.mobilePhones.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection
