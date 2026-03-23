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

<div class="trust-marquee-wrap">
            <div class="trust-marquee">
                <div class="trust-marquee-track">
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Ethically Sourced
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        Free UK Delivery over £50
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        Thoughtful Packaging
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Secure Checkout
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        30-Day Returns
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Ethically Sourced
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        Free UK Delivery over £50
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        Thoughtful Packaging
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Secure Checkout
                    </span>
                    <span class="trust-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        30-Day Returns
                    </span>
                </div>
            </div>
        </div>


        <section class="category-section">
            <div class="section-heading">
                <p class="section-kicker">Shop the collection</p>
                <h2>Explore by category</h2>
            </div>

            <div class="category-grid">
                <a href="{{ route('shop.rings') }}" class="category-card category-rings">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Rings</h3>
                    </div>
                </a>

                <a href="{{ route('shop.necklaces') }}" class="category-card category-necklaces">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Necklaces</h3>
                    </div>
                </a>

                <a href="{{ route('shop.bracelets') }}" class="category-card category-bracelets">
                    <div class="category-card-content">
                        <p>Stone & Soul</p>
                        <h3>Bracelets</h3>
                    </div>
                </a>

                <a href="{{ route('shop.earrings') }}" class="category-card category-earrings">
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

         <section class="testimonials-section fade-in">
            <div class="section-heading">
                <p class="section-kicker">Customer love</p>
                <h2>What our customers say</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-quote">"The necklace I ordered is absolutely gorgeous. The packaging was so thoughtful — I felt like I was opening a gift even as the buyer."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">S</div>
                        <div>
                            <strong>Sophie T.</strong>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-quote">"Beautifully made rings that actually last. I've been wearing mine every day for 6 months with no tarnishing. Worth every penny."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">M</div>
                        <div>
                            <strong>Maya R.</strong>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-quote">"Love that this brand genuinely cares about ethical sourcing. The earrings are delicate, elegant, and arrived so quickly."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">J</div>
                        <div>
                            <strong>Jasmine L.</strong>
                            <span>Verified Buyer</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection