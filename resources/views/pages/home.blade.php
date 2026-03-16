@extends('layouts.app')

@section('title', 'Stone & Soul - Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/components/productcard.css') }}" />
@endpush

@section('content')
    <main class="home-page">
        @if ($isAdmin)
            <div class="home-admin-banner">
                <a class="home-admin-button" href="{{ route('admin.dashboard') }}">Go to admin dashboard</a>
            </div>
        @endif

        <section class="feature">
            <div class="feature-overlay"></div>

            <div class="feature-text">
                <p class="feature-subtitle">Ethical fine jewellery</p>
                <h1>Jewellery rooted in nature, made to feel timeless.</h1>
                <p class="feature-description">
                    Discover thoughtfully crafted pieces inspired by earth tones, conscious design, and everyday elegance.
                </p>

                <div class="feature-buttons">
                    <a class="feature-link primary" href="{{ route('shop') }}">Shop Collection</a>
                    <a class="feature-link secondary" href="{{ route('about') }}">Our Story</a>
                </div>
            </div>
        </section>

        <section class="trust-strip">
            <div class="trust-item">
                <span>Ethically sourced</span>
            </div>
            <div class="trust-item">
                <span>Thoughtful packaging</span>
            </div>
            <div class="trust-item">
                <span>Secure checkout</span>
            </div>
            <div class="trust-item">
                <span>Fast UK delivery</span>
            </div>
        </section>

        <section class="category-section">
            <div class="section-heading">
                <p class="section-kicker">Shop the collection</p>
                <h2>Explore by category</h2>
            </div>

            <div class="category-grid">
                <a href="{{ route('shop') }}#rings" class="category-card category-rings">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Rings</h3>
                    </div>
                </a>

                <a href="{{ route('shop') }}#necklaces" class="category-card category-necklaces">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Necklaces</h3>
                    </div>
                </a>

                <a href="{{ route('shop') }}#bracelets" class="category-card category-bracelets">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Bracelets</h3>
                    </div>
                </a>

                <a href="{{ route('shop') }}#earrings" class="category-card category-earrings">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Earrings</h3>
                    </div>
                </a>
            </div>
        </section>

        <section class="featured-section">
            <div class="section-heading split-heading">
                <div>
                    <p class="section-kicker">Curated edit</p>
                    <h2>Featured pieces</h2>
                </div>
                <a href="{{ route('shop') }}" class="text-link">View all jewellery</a>
            </div>

            <div class="products">
                @foreach ($products as $product)
                    <a href="{{ '/product/' . $product->ProductID }}" class="productcard">
                        <div class="productcard-image-wrap">
                            <img src="{{ asset($product->Image_URL) }}" class="productcard-image"
                                alt="{{ $product->Product_Name }}" />
                        </div>
                        <div class="productcard-body">
                            <h3 class="productcard-title">{{ $product->Product_Name }}</h3>
                            <p class="productcard-description">{{ Str::limit($product->Description, 70) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="story-section">
            <div class="story-image"></div>
            <div class="story-copy">
                <p class="section-kicker">Our promise</p>
                <h2>Earth-led design with a softer, more conscious approach.</h2>
                <p>
                    At Stone & Soul, we believe jewellery should feel meaningful. Our collections are inspired by natural textures,
                    warm tones, and timeless forms, with a focus on ethical sourcing and thoughtful craftsmanship.
                </p>
                <a href="{{ route('about') }}" class="feature-link dark">Read more</a>
            </div>
        </section>
    </main>
@endsection