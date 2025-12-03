<div class="top-strip"></div>

<div class="nav-div">
    <div class="nav-img">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Stone & Soul">
    </div>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-item">Home</a>
        <a href="{{ route('shop') }}" class="nav-item">Shop All</a>
        <a href="{{ route('shop') }}" class="nav-item">Necklaces</a>
        <a href="{{ route('shop') }}" class="nav-item">Bracelets</a>
        <a href="{{ route('shop') }}" class="nav-item">Rings</a>
        <a href="{{ route('contact') }}" class="nav-item">Contact</a>

        <div class="nav-user-area">
            <a href="{{ route('basket') }}" aria-label="Basket">
                <img src="{{ asset('assets/svg/cart.svg') }}" class="nav-icon-link" class="nav-icon" alt="Basket">
            </a>
            <a href="{{ route('account') }}" aria-label="Account">
                <img src="{{ asset('assets/svg/person-sharp.svg') }}" class="nav-icon-link" alt="User Account">
            </a>
        </div>
    </nav>
</div>