@extends('layouts.app')

@section('title', 'Your Wishlist')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/wishlist.css') }}">
@endpush

@section('content')
    <div class="wishlist-container">
        <h1 class="wishlist-title">Your Wishlist</h1>

        @if (session('success'))
            <p class="wishlist-alert">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="wishlist-alert wishlist-alert-error">{{ session('error') }}</p>
        @endif

        {{-- Backend will pass $items variable with wishlist items --}}
        @if (isset($items) && !$items->isEmpty())
            <div class="wishlist-grid">
                @foreach ($items as $item)
                    <div class="wishlist-card">
                        <div class="wishlist-image-wrapper">
                            <a href="{{ route('product', $item->product->ProductID) }}">
                                <img src="{{ asset($item->product->Image_URL) }}" 
                                     alt="{{ $item->product->Product_Name }}" 
                                     class="wishlist-image">
                            </a>
                            
                            {{-- Remove from Wishlist Button --}}
                            <form action="{{ route('wishlist.remove', $item->ProductID) }}" method="POST" class="wishlist-remove-form">
                                @csrf
                                <button type="submit" class="wishlist-remove-btn" aria-label="Remove from wishlist">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="wishlist-info">
                            <a href="{{ route('product', $item->product->ProductID) }}" class="wishlist-product-link">
                                <h3 class="wishlist-product-name">{{ $item->product->Product_Name }}</h3>
                            </a>
                            <p class="wishlist-product-price">£{{ number_format($item->product->Price, 2) }}</p>
                            
                            {{-- Add to Cart Button --}}
                            <form action="{{ route('cart.add', $item->product->ProductID) }}" method="POST">
                                @csrf
                                <button type="submit" class="wishlist-add-cart-btn">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty Wishlist State --}}
            <div class="wishlist-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="wishlist-empty-icon">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
                <p class="wishlist-empty-text">Your wishlist is empty</p>
                <a href="{{ route('shop') }}" class="wishlist-shop-btn">Browse Products</a>
            </div>
        @endif
    </div>
@endsection