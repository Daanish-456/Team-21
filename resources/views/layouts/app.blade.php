<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Stone & Soul')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/logo-stone-soul.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/footer.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/productcard.css') }}">
    @stack('styles')
</head>

<body>
    <header>
        @include('components.navbar')
    </header>

    <div class="content-container">
        @yield('content')
    </div>

    @include('components.footer')

    <script>
        (function () {
            const root = document.documentElement;

            function applyTheme(theme) {
                root.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);

                const toggle = document.getElementById('themeToggle');
                if (toggle) toggle.checked = (theme === 'dark');
            }

            const saved = localStorage.getItem('theme');
            applyTheme(saved || 'light');

            window.addEventListener('DOMContentLoaded', () => {
                const toggle = document.getElementById('themeToggle');
                if (!toggle) return;

                toggle.addEventListener('change', () => {
                    applyTheme(toggle.checked ? 'dark' : 'light');
                });
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>