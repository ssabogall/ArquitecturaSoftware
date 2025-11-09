{{--
    View: Admin Dashboard
    Purpose: Muestra el panel principal del administrador con accesos y widgets de métricas.

    @author Alejandro Carmona
--}}
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
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">{{ __('messages.view') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-bag-check me-2"></i>{{ __('messages.orders') }}</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">{{ __('messages.view') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-phone me-2"></i>{{ __('messages.products') }}</h5>
                    <a href="{{ route('admin.mobilePhones.index') }}" class="btn btn-primary btn-sm">{{ __('messages.view') }}</a>
                </div>
            </div>
        </div>
    </div>

        <div class="row g-3 mt-3">
            <div class="col-12">
                <div class="alert alert-info d-flex align-items-center justify-content-between" role="alert">
                    <div>
                        <i class="bi bi-chat-square-quote me-2"></i>
                        {{ __('messages.pending_reviews_widget', ['count' => $viewData['pendingReviewsCount'] ?? 0]) }}
                    </div>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
        <div class="col-md-3">
            <div class="card text-bg-light h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">{{ __('messages.users') }}</div>
                            <div class="display-6">{{ $viewData['activeUsersCount'] ?? 0 }}</div>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">{{ __('messages.products') }}</div>
                            <div class="display-6">{{ $viewData['productsCount'] ?? 0 }}</div>
                        </div>
                        <i class="bi bi-phone fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-bg-light h-100">
                <div class="card-body">
                    <div class="fw-semibold mb-2">{{ __('messages.orders') }}</div>
                    <div class="row text-center">
                        <div class="col">
                            <div class="small text-uppercase">{{ __('messages.pending') }}</div>
                            <div class="fs-4">{{ $viewData['ordersByStatus']['pending'] ?? 0 }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-uppercase">{{ __('messages.paid') }}</div>
                            <div class="fs-4">{{ $viewData['ordersByStatus']['paid'] ?? 0 }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-uppercase">{{ __('messages.shipped') }}</div>
                            <div class="fs-4">{{ $viewData['ordersByStatus']['shipped'] ?? 0 }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-uppercase">{{ __('messages.cancelled') }}</div>
                            <div class="fs-4">{{ $viewData['ordersByStatus']['cancelled'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
