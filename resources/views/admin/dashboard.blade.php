@extends('layouts.admin')

@section('title', __('messages.admin_panel'))
@section('header', __('messages.admin_panel'))

@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people me-2"></i>{{ __('messages.users') }}</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">{{ __('messages.view') ?? 'Ver' }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-bag-check me-2"></i>{{ __('messages.orders') }}</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">{{ __('messages.view') ?? 'Ver' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
