{{--
    View: Layout App
    Purpose: Layout base público para páginas de la aplicación.

    @author Alejandro Carmona
--}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    
    <title>@yield('title', __('messages.app_title'))</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center mb-0" href="{{ route('home.index') }}" aria-label="{{ __('messages.app_title') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.app_title') }}" style="height: 84px; width: auto;" />
            </a>

            <!-- Auth Links -->
            <div class="navbar-nav ms-auto d-flex flex-row gap-3 align-items-center">
                @guest
                    <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                    <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                @else
                    <span class="navbar-text text-dark me-2">
                        {{ Auth::user()->getName() }}
                    </span>

                    <!-- Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <a role="button" class="nav-link text-dark"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('messages.logout') }}
                        </a>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer bg-secondary text-white text-center py-4">
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
