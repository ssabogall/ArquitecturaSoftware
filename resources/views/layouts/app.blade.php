{{--
    View: Layout App
    Purpose: Layout base público para páginas de la aplicación.

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    
    <title>@yield('title', __('messages.app_title'))</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center mb-0" href="{{ route('home.index') }}" aria-label="{{ __('messages.app_title') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.app_title') }}" style="height: 84px; width: auto;" />
            </a>

            <!-- Nav Links -->
            <div class="navbar-nav ms-auto d-flex flex-row gap-3 align-items-center">
                <a class="nav-link text-dark" href="{{ route('mobilePhones.index') }}">{{ __('messages.products') }}</a>
                <!-- Cart icon -->
                <a class="nav-link text-dark d-flex align-items-center" href="{{ route('cart.index') }}" title="{{ __('messages.cart') }}" aria-label="{{ __('messages.cart') }}">
                    <i class="bi bi-cart fs-5"></i>
                    <span class="visually-hidden">{{ __('messages.cart') }}</span>
                </a>
                @guest
                    <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                    <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                @else
                    <!-- User dropdown as icon -->
                    <div class="dropdown nav-hover-dropdown me-2">
                        <a href="#" class="nav-link dropdown-toggle text-dark d-flex align-items-center" id="userMenu" role="button" aria-expanded="false" title="{{ __('messages.profile') }}">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="visually-hidden">{{ Auth::user()->getName() }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <h6 class="dropdown-header">{{ __('messages.hello_name', ['name' => Auth::user()->getName()]) }}</h6>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('messages.my_profile') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('order.index') }}">{{ __('messages.my_orders') }}</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('messages.logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-4">
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
    </div>

    <!-- Footer -->
    <footer class="footer bg-secondary text-white text-center py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-muted">
                        &copy; {{ date('Y') }} - {{ __('messages.app_title') }}
                        <br>
                        {{ __('messages.rights_reserved') }}
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
