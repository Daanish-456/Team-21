@extends('layouts.app')

@section('title', 'Stone & Soul - Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/components/productcard.css') }}" />
@endpush

@section('content')
    @if ($isAdmin)
        <div class="home-admin-banner">
            <a class="home-admin-button" href="{{ route('admin.dashboard') }}">Go to admin dashboard</a>
        </div>
    @endif

    <section class="feature">
        <div class="feature-overlay"></div>

        <div class="feature-text">
            <p class="feature-subtitle">Ethical Fine Jewellery</p>
            <h1>Ethically Sourced. Soulfully Crafted.</h1>

            <p class="feature-description">
                Discover jewellery that honors the earth and elevates your spirit.
            </p>

            <div class="feature-buttons">
                <a class="feature-link primary" href="{{ route('shop') }}">Shop Collection</a>
                <a class="feature-link secondary" href="{{ route('about') }}">Our Story</a>
            </div>
        </div>
    </section>

    <section class="trust-strip">
        <div class="trust-item">Secure Checkout</div>
        <div class="trust-item">Ethically Sourced</div>
        <div class="trust-item">Thoughtful Packaging</div>
        <div class="trust-item">Fast Delivery</div>
    </section>

    <section class="category-section">
        <div class="section-heading">
            <h2>Shop by Category</h2>
            <p>Explore timeless pieces designed for every occasion.</p>
        </div>

        <div class="category-grid">
            <a href="{{ route('shop') }}" class="category-card">Rings</a>
            <a href="{{ route('shop') }}" class="category-card">Necklaces</a>
            <a href="{{ route('shop') }}" class="category-card">Bracelets</a>
            <a href="{{ route('shop') }}" class="category-card">Earrings</a>
        </div>
    </section>

    <section class="featured-section">
        <div class="section-heading">
            <h2>Featured Products</h2>
            <p>Discover some of our most loved sustainable jewellery pieces.</p>
        </div>

        <div class="products">
            @foreach ($products as $product)
                <a href="{{ '/product/' . $product->ProductID }}" class="productcard">
                    <img src="{{ asset($product->Image_URL) }}" class="productcard-image"
                        alt="{{ $product->Product_Name }}" />
                    <div class="productcard-body">
                        <h3 class="productcard-title">{{ $product->Product_Name }}</h3>
                        <p class="productcard-description">{{ $product->Description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="about">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Stone & Soul Logo" class="about-logo" />
        <div class="about-text">
            <h1>Our Promise</h1>
            <p>
                At Stone & Soul we promise that the products we list are high quality, ethically sourced and
                environmentally friendly.
            </p>
        </div>
    </section>
@endsection