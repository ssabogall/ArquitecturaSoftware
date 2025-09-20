{{--
  View: Admin Products Show
  Purpose: Muestra el detalle de un producto en el panel de administrador.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.product_details'))
@section('header', __('messages.product_details'))

@section('content')
<div class="card">
  <div class="card-body">
    <dl class="row mb-0">
      <dt class="col-sm-3">{{ __('messages.id') }}</dt>
  <dd class="col-sm-9">{{ $product->getId() }}</dd>

      <dt class="col-sm-3">{{ __('messages.name') }}</dt>
  <dd class="col-sm-9">{{ $product->getName() }}</dd>

      <dt class="col-sm-3">{{ __('messages.brand') }}</dt>
  <dd class="col-sm-9">{{ $product->getBrand() }}</dd>

      <dt class="col-sm-3">{{ __('messages.price') }}</dt>
  <dd class="col-sm-9">{{ $product->getPrice() }}</dd>

      <dt class="col-sm-3">{{ __('messages.stock') }}</dt>
  <dd class="col-sm-9">{{ $product->getStock() }}</dd>

      <dt class="col-sm-3">{{ __('messages.photo_url') }}</dt>
      <dd class="col-sm-9">
        @if($product->getPhotoUrl())
          <div class="mb-2"><a href="{{ $product->getPhotoUrl() }}" target="_blank" rel="noopener noreferrer">{{ $product->getPhotoUrl() }}</a></div>
          <img src="{{ $product->getPhotoUrl() }}" alt="{{ $product->getName() }}" style="max-width: 240px; height: auto;" />
        @else
          {{ __('messages.not_provided') }}
        @endif
      </dd>

      <dt class="col-sm-3">{{ __('messages.created_at') }}</dt>
  <dd class="col-sm-9">{{ $product->getCreatedAt() }}</dd>

      <dt class="col-sm-3">{{ __('messages.updated_at') }}</dt>
  <dd class="col-sm-9">{{ $product->getUpdatedAt() }}</dd>
    </dl>
    <div class="mt-3">
  <a href="{{ route('admin.products.edit', $product->getId()) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
      <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.back') }}</a>
    </div>
  </div>
</div>
@endsection
