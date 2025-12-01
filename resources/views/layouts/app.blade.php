<!DOCTYPE html>
<html lang="en">

head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Stone & Soul')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/footer.css') }}">

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

    @stack('scripts')
</body>

</html>
