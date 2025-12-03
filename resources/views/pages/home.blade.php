@extends('layouts.app')

@section('title', 'Stone & Soul - Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/components/productcard.css') }}" />
@endpush

@section('content')
    <div class="feature">
        <div class="feature-text">
            <h1>Ethically Sourced. Soulfully Crafted.</h1>
            <p>Discover jewellery that honors the earth and elevates your spirit.</p>
        </div>

        <a class="feature-link" href="{{ route('shop') }}">Explore Items</a>
    </div>
    <div class="products">
        @foreach ($products as $product)
            <a href={{ '/product/' . $product->ProductID }} class="productcard">
                <img src="{{ asset($product->Image_URL) }}" class="productcard-image" alt="Product Image" />
                <h1 class="productcard-title">{{ $product->Product_Name }}</h1>
                <p class="productcard-description">{{ $product->Description }}</p>
            </a>
        @endforeach
    </div>

    <div class="about">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Stone & Soul Logo" class="about-logo" />
        <div class="about-text">
            <h1>Our Promise</h1>
            <p>
                At Stone & Soul we promise that the products we list are high quality, ethically sourced and environmentally
                friendly.
            </p>
        </div>
    </div>
@endsection