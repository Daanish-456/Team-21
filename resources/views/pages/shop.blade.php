@extends('layouts.app')

@section('title', 'Stone & Soul - ' . ($pageTitle ?? 'Shop'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
    <style>
        .shop-page {
            min-height: calc(100vh - 120px);
            padding: 3rem 0 4rem;
        }

        .shop-hero {
            max-width: 880px;
            margin: 0 auto 2rem;
            text-align: center;
        }

        .shop-hero h1 {
            font-size: 2.4rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            color: #3c2f2f;
        }

        .shop-hero p {
            font-size: 0.98rem;
            color: #6b5c55;
            max-width: 680px;
            margin: 0 auto;
        }

        .shop-category-nav {
            max-width: 1080px;
            margin: 0 auto 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            justify-content: center;
        }

        .shop-category-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.2rem;
            border-radius: 999px;
            border: 1px solid #dccab4;
            background: #fffaf5;
            color: #4d3d36;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .shop-category-link:hover {
            background: #f5e9db;
            border-color: #c7a87c;
            transform: translateY(-1px);
        }

        .shop-category-link.active {
            background: #3c2f2f;
            color: #ffffff;
            border-color: #3c2f2f;
        }

        .shop-results-summary {
            max-width: 1080px;
            margin: 0 auto 1.5rem;
            text-align: center;
            color: #6b5c55;
            font-size: 0.95rem;
        }

        .shop-grid-wrap {
            max-width: 1080px;
            margin: 0 auto;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.4rem;
        }

        .product-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card {
            height: 100%;
            background: #fdfaf5;
            border-radius: 18px;
            border: 1px solid #e4d7c4;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition:
                transform 0.15s ease,
                box-shadow 0.15s ease,
                border-color 0.15s ease,
                background 0.15s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
            border-color: #c7a87c;
            background: #ffffff;
        }

        .product-image-wrapper {
            position: relative;
            padding-top: 110%;
            overflow: hidden;
            background: #f1e6d7;
        }

        .product-image-wrapper img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image-wrapper img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 0.85rem 0.9rem 1rem;
        }

        .product-title {
            font-size: 0.98rem;
            margin-bottom: 0.2rem;
            color: #3c2f2f;
        }

        .product-price {
            font-weight: 600;
            font-size: 0.92rem;
            color: #9b7a54;
            margin-bottom: 0.35rem;
        }

        .product-tagline {
            font-size: 0.82rem;
            color: #84726a;
            line-height: 1.45;
        }

        .no-products {
            text-align: center;
            padding: 2rem 1rem;
            color: #6b5c55;
        }

        @media (max-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .shop-page {
                padding: 2rem 0 3rem;
            }

            .shop-hero h1 {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
            }
        }

        @media (max-width: 520px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="shop-page">
        <section class="shop-hero">
            <h1>{{ $pageTitle ?? 'Shop All' }}</h1>
            <p>{{ $pageDescription ?? 'Explore our curated jewellery collection.' }}</p>
        </section>

        <nav class="shop-category-nav" aria-label="Shop categories">
            <a href="{{ route('shop') }}"
               class="shop-category-link {{ ($activeCategory ?? 'all') === 'all' ? 'active' : '' }}">
                Shop All
            </a>

            <a href="{{ route('shop.category', 'necklaces') }}"
               class="shop-category-link {{ ($activeCategory ?? '') === 'necklaces' ? 'active' : '' }}">
                Necklaces
            </a>

            <a href="{{ route('shop.category', 'earrings') }}"
               class="shop-category-link {{ ($activeCategory ?? '') === 'earrings' ? 'active' : '' }}">
                Earrings
            </a>

            <a href="{{ route('shop.category', 'bracelets') }}"
               class="shop-category-link {{ ($activeCategory ?? '') === 'bracelets' ? 'active' : '' }}">
                Bracelets
            </a>

            <a href="{{ route('shop.category', 'rings') }}"
               class="shop-category-link {{ ($activeCategory ?? '') === 'rings' ? 'active' : '' }}">
                Rings
            </a>
        </nav>

        <div class="shop-results-summary">
            @if(!empty($searchTerm))
                <p>{{ $products->count() }} result{{ $products->count() === 1 ? '' : 's' }} for "{{ $searchTerm }}"</p>
            @else
                <p>{{ $products->count() }} product{{ $products->count() === 1 ? '' : 's' }} available</p>
            @endif
        </div>

        <div class="shop-grid-wrap">
            @if($products->count())
                <div class="products-grid">
                    @foreach ($products as $product)
                        <a href="{{ route('product', $product->ProductID) }}" class="product-card-link">
                            <article class="product-card">
                                <div class="product-image-wrapper">
                                    <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}">
                                </div>

                                <div class="product-info">
                                    <h3 class="product-title">{{ $product->Product_Name }}</h3>
                                    <p class="product-price">£{{ number_format($product->Price, 2) }}</p>
                                    <p class="product-tagline">{{ $product->Description }}</p>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="no-products">
                    <p>No products found.</p>
                </div>
            @endif
        </div>
    </div>
@endsection