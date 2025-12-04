<div class="top-strip"></div>

<div class="nav-div">
    <div class="nav-img">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Stone & Soul">
    </div>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-item">Home</a>
        <a href="{{ route('shop') }}" class="nav-item">Shop All</a>
        <a href="{{ route('shop') }}#necklaces" class="nav-item">Necklaces</a>
        <a href="{{ route('shop') }}#bracelets" class="nav-item">Bracelets</a>
        <a href="{{ route('shop') }}#rings" class="nav-item">Rings</a>
        <a href="{{ route('contact') }}" class="nav-item">Contact</a>

        <div class="nav-user-area">
            
            {{-- Search Bar --}}
            <form action="{{ route('search') }}" method="GET" class="nav-search-form">
                <input type="text" name="q" placeholder="Search products..." class="nav-search-input" required>
                <button type="submit" class="nav-search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </form>

               {{-- User Account and Basket Icons --}}
            <a href="{{ route('basket') }}" class="nav-item" aria-label="Basket">
                <img src="{{ asset('assets/svg/cart.svg') }}" class="nav-icon" alt="Basket">
            </a>
            <a href="{{ route('account') }}" class="nav-item" aria-label="Account">
                <img src="{{ asset('assets/svg/person-sharp.svg') }}" class="nav-icon" alt="User Account">
            </a>
        </div>
    </nav>
</div>