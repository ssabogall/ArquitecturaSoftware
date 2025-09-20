{{--
  View: Admin Products Create
  Purpose: Muestra el formulario para crear un nuevo producto.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.new_product'))
@section('header', __('messages.new_product'))

@section('content')
<div class="card">
  <div class="card-body">
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @include('admin.products.partials.form', ['product' => $product])
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection
