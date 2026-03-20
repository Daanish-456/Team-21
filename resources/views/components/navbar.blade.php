<div class="top-strip">
    Handcrafted jewellery inspired by nature, soul, and timeless design.
</div>

<header class="nav-div">
    <div class="nav-shell">
        <div class="nav-left">
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <a href="{{ route('home') }}" class="nav-brand" aria-label="Stone and Soul home">
            <img src="{{ asset('assets/images/logo/logo-stone-soul.png') }}" alt="Stone & Soul">
        </a>

        <div class="nav-user-area">
            <form action="{{ route('search') }}" method="GET" class="nav-search-form">
                <input type="text" name="q" placeholder="Search products..." class="nav-search-input">
                <button type="submit" class="nav-search-btn" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </form>

            <a href="{{ route('wishlist') }}" class="icon-link" aria-label="Wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </a>

            <a href="{{ route('basket') }}" class="icon-link" aria-label="Basket">
                <img src="{{ asset('assets/svg/cart.svg') }}" class="nav-icon-img" alt="Basket">
            </a>

            <a href="{{ route('account') }}" class="icon-link" aria-label="Account">
                <img src="{{ asset('assets/svg/person-sharp.svg') }}" class="nav-icon-img" alt="User Account">
            </a>

            <label class="theme-switch" aria-label="Toggle dark mode">
                <input type="checkbox" id="themeToggle">
                <span class="slider"></span>
            </label>
        </div>
    </div>
</header>

<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<aside class="mobile-drawer" id="mobileDrawer">
    <div class="mobile-drawer-header">
        <span>Menu</span>
        <button id="closeMobileMenu" aria-label="Close menu">✕</button>
    </div>

    <nav class="mobile-drawer-nav">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('shop') }}">Shop All</a>
<<<<<<< HEAD
        <a href="{{ route('shop.necklaces') }}">Necklaces</a>
        <a href="{{ route('shop.earrings') }}">Earrings</a>
        <a href="{{ route('shop.bracelets') }}">Bracelets</a>
        <a href="{{ route('shop.rings') }}">Rings</a>
=======
        <a href="{{ route('shop.category', 'necklaces') }}">Necklaces</a>
        <a href="{{ route('shop.category', 'earrings') }}">Earrings</a>
        <a href="{{ route('shop.category', 'bracelets') }}">Bracelets</a>
        <a href="{{ route('shop.category', 'rings') }}">Rings</a>
>>>>>>> c7161b93da30fe8bdc05cf60b87a6c73e7c646c2
        <a href="{{ route('contact') }}">Contact</a>
    </nav>
</aside>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("mobileMenuToggle");
    const closeBtn = document.getElementById("closeMobileMenu");
    const drawer = document.getElementById("mobileDrawer");
    const overlay = document.getElementById("mobileMenuOverlay");

    function openMenu() {
        drawer.classList.add("active");
        overlay.classList.add("active");
        document.body.style.overflow = "hidden";
    }

    function closeMenu() {
        drawer.classList.remove("active");
        overlay.classList.remove("active");
        document.body.style.overflow = "";
    }

    if (menuToggle) menuToggle.addEventListener("click", openMenu);
    if (closeBtn) closeBtn.addEventListener("click", closeMenu);
    if (overlay) overlay.addEventListener("click", closeMenu);
});
</script>