{{--
  View: Admin Users Show
  Purpose: Shows the details of a user in the admin panel.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.user_details'))
@section('header', __('messages.user_details'))

@section('content')
<div class="card">
  <div class="card-body">
    <dl class="row mb-0">
  <dt class="col-sm-3">{{ __('messages.id') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getId() }}</dd>

      <dt class="col-sm-3">{{ __('messages.name') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getName() }}</dd>

      <dt class="col-sm-3">{{ __('messages.email') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getEmail() }}</dd>

      <dt class="col-sm-3">{{ __('messages.staff') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->isStaff() ? __('messages.yes') : __('messages.no') }}</dd>

      <dt class="col-sm-3">{{ __('messages.phone') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getPhone() ?? __('messages.not_provided') }}</dd>

      <dt class="col-sm-3">{{ __('messages.address') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getAddress() ?? __('messages.not_provided') }}</dd>

      <dt class="col-sm-3">{{ __('messages.balance') }}</dt>
  <dd class="col-sm-9 fw-bold text-success">{{ __('messages.currency_symbol') }}{{ number_format($viewData['user']->getBalance(), 0, ',', '.') }}</dd>

      <dt class="col-sm-3">{{ __('messages.created_at') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getCreatedAt() }}</dd>

      <dt class="col-sm-3">{{ __('messages.updated_at') }}</dt>
  <dd class="col-sm-9">{{ $viewData['user']->getUpdatedAt() }}</dd>
    </dl>
    <div class="mt-3">
  <a href="{{ route('admin.users.edit', ['user' => $viewData['user']->getId()]) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
      <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.back') }}</a>
    </div>
  </div>
</div>
@endsection