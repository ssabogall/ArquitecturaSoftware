{{--
  View: Admin Products Edit
  Purpose: Muestra el formulario para editar un producto existente.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.edit_product'))
@section('header', __('messages.edit_product'))

@section('content')
<div class="card">
  <div class="card-body">
  <form action="{{ route('admin.products.update', $product->getId()) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('admin.products.partials.form', ['product' => $product])
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection
