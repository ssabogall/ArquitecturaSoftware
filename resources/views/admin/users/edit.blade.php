@extends('layouts.admin')

@section('title', __('messages.edit_user'))
@section('header', __('messages.edit_user'))

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')
      @include('admin.users.partials.form', ['user' => $user])
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
  </div>
</div>
@endsection