@extends('layouts.app')

@section('title', 'Stone & Soul - ' . $product->Product_Name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
@endpush

@section('content')
    <div class="container">
        <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}" />

        <div class="product-details">
            <h1>{{ $product->Product_Name }}</h1>
            <p class="stock-info" style="{{ $product->Stock < 3 ? 'color: red;' : '' }}">
                {{ $product->Stock }} in stock
            </p>
            <p>{{ $product->Description }}</p>
            <h2>£{{ number_format($product->Price, 2) }}</h2>
            <form action="{{ route('cart.add', $product->ProductID) }}" method="POST">
                @csrf
                <button type="submit" class="cart-button btn">
                    Add To Cart
                </button>
            </form>

                {{-- Add to Wishlist Button --}}
                <form action="{{ route('wishlist.add', $product->ProductID) }}" method="POST">
                    @csrf
                    <button type="submit" class="wishlist-button btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        Add to Wishlist
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection