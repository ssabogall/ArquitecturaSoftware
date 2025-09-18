<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    
    <title>@yield('title', __('Online Store'))</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand mb-0 h1" href="{{ route('home.index') }}">{{ __('Online Store') }}</a>
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
                        &copy; {{ date('Y') }} - {{ __('Online Store') }}
                        <br>
                        {{ __('All rights reserved') }}
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