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
        <a href="{{ route('contact') }}" class="nav-item">Contact Us</a>
        <div class="nav-user-area">
            <a href="{{ route('shop') }}" class="nav-item">
                <img src="{{ asset('assets/svg/cart.svg') }}" class="nav-icon" alt="Cart" />
            </a>
            <a href="" class="nav-item">
                <img src="{{ asset('assets/svg/person-sharp.svg') }}" class="nav-icon" alt="User Account">
            </a>
        </div>
    </nav>
</div>