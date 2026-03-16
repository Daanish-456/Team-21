<link rel="icon" type="image/png" href="{{ asset('assets/images/logo/logo-stone-soul.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">


<div class="top-strip">
    Complimentary UK delivery on orders over £50
</div>


<header class="site-header">

    <div class="header-top">

        <div class="header-left"></div>

        <div class="nav-img">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Stone & Soul">
        </div>

        <div class="nav-user-area">

            <form action="{{ route('search') }}" method="GET" class="nav-search-form">
                <input type="text" name="q" placeholder="Search">
                <button type="submit">🔍</button>
            </form>

            <a href="{{ route('wishlist') }}" class="nav-icon">❤</a>

            <a href="{{ route('basket') }}">
                <img src="{{ asset('assets/svg/cart.svg') }}" class="nav-icon">
            </a>

            <a href="{{ route('account') }}">
                <img src="{{ asset('assets/svg/person-sharp.svg') }}" class="nav-icon">
            </a>

            <label class="theme-switch">
                <input type="checkbox" id="themeToggle">
                <span class="slider"></span>
            </label>

        </div>

    </div>


    <nav class="main-nav">

        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">Our Story</a>
        <a href="{{ route('shop') }}">Shop All</a>
        <a href="{{ route('shop') }}#necklaces">Necklaces</a>
        <a href="{{ route('shop') }}#earrings">Earrings</a>
        <a href="{{ route('shop') }}#bracelets">Bracelets</a>
        <a href="{{ route('shop') }}#rings">Rings</a>
        <a href="{{ route('contact') }}">Contact</a>

    </nav>

</header>