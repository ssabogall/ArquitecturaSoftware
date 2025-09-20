{{--
  View: Admin Users Create
  Purpose: Muestra el formulario para crear un nuevo usuario en admin.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.new_user'))
@section('header', __('messages.new_user'))

@section('content')
<div class="card">
  <div class="card-body">
  <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      @include('admin.users.partials.form', ['user' => $user])
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection