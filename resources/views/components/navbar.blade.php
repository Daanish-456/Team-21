<div class="top-strip"></div>

<div class="nav-div">
    <div class="nav-img">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Stone & Soul">
    </div>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-item">Home</a>
        <a href="{{ route('about') }}" class=" nav-item">About</a>
        <a href="{{ route('shop') }}" class="nav-item">Shop All</a>
        <a href="{{ route('shop') }}#necklaces" class="nav-item">Necklaces</a>
        <a href="{{ route('shop') }}#earrings" class="nav-item">Earrings</a>
        <a href="{{ route('shop') }}#bracelets" class="nav-item">Bracelets</a>
        <a href="{{ route('shop') }}#rings" class="nav-item">Rings</a>
        <a href="{{ route('contact') }}" class="nav-item">Contact</a>

        <div class="nav-user-area">
            <form action="{{ route('search') }}" method="GET" class="nav-search-form">
                <input type="text" name="q" placeholder="Search products..." class="nav-search-input" required>
                <button type="submit" class="nav-search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </form>


            <a href="{{ route('wishlist') }}" class="nav-item" aria-label="Wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </a>

            
            <a href="{{ route('basket') }}" class="nav-item" aria-label="Basket">
                <img src="{{ asset('assets/svg/cart.svg') }}" class="nav-icon" alt="Basket">
            </a>

            
            <a href="{{ route('account') }}" class="nav-item" aria-label="Account">
                <img src="{{ asset('assets/svg/person-sharp.svg') }}" class="nav-icon" alt="User Account">
            </a>
            
            <label class="theme-switch" aria-label="Toggle dark mode">
                <input type="checkbox" id="themeToggle">
                <span class="slider"></span>
            </label>

        </div>
    </nav>
</div>