{{--
    View: Layout Admin
    Purpose: Layout base para el panel de administración.

    @author Alejandro Carmona
    @author Miguel Arcila
--}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />

    <title>@yield('title', __('messages.admin_panel'))</title>
</head>

<body class="min-vh-100 d-flex flex-column">
<div class="admin-layout d-flex flex-grow-1">
    <!-- Sidebar -->
    <nav class="admin-sidebar d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" title="{{ __('messages.dashboard') }}" class="nav-link">
                    <i class="bi bi-house-door me-2"></i><span class="label">{{ __('messages.dashboard') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" title="{{ __('messages.users') }}" class="nav-link">
                    <i class="bi bi-people me-2"></i><span class="label">{{ __('messages.users') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}" title="{{ __('messages.orders') }}" class="nav-link">
                    <i class="bi bi-bag-check me-2"></i><span class="label">{{ __('messages.orders') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.mobilePhones.index') }}" title="{{ __('messages.products') }}" class="nav-link">
                    <i class="bi bi-phone me-2"></i><span class="label">{{ __('messages.products') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.specifications.index') }}" title="{{ __('messages.specifications') }}" class="nav-link">
                    <i class="bi bi-sliders me-2"></i><span class="label">{{ __('messages.specifications') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews.index') }}" title="{{ __('messages.reviews') }}" class="nav-link">
                    <i class="bi bi-chat-square-quote me-2"></i><span class="label">{{ __('messages.reviews') }}</span>
                </a>
            </li>
        </ul>
        <hr>
        <div class="mt-auto d-grid gap-2">
            <a href="{{ route('home.index') }}" title="{{ __('messages.home') }}" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-house me-2"></i><span class="label">{{ __('messages.home') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="{{ __('messages.logout') }}" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-right me-2"></i><span class="label">{{ __('messages.logout') }}</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main content -->
    <main class="admin-main flex-fill d-flex flex-column">
        <header class="admin-header border-bottom p-3">
            <h1 class="h4 m-0">@yield('header', __('messages.dashboard'))</h1>
        </header>
        <section class="admin-content p-4 flex-grow-1">
            @if (session('flash.message'))
                <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                    {{ session('flash.message') }}
                </div>
            @elseif (session('flash.message_key'))
                <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                    {{ __(session('flash.message_key')) }}
                </div>
            @endif
            @yield('content')
        </section>
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
