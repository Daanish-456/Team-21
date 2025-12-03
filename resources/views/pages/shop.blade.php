@extends('layouts.app')

<<<<<<< HEAD
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
        @include('components.productcard')
        @include('components.productcard')
        @include('components.productcard')
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
=======
@section('title', 'Stone & Soul - Browse')

@section('content')
    <div>
        {{-- test --}}
        @foreach ($products as $product)
            <p>{{ $product->Product_Name . $product->Price}}</p>
        @endforeach
>>>>>>> 6d232a86c05a9e47c0ce83e7dba22c0ba12d303d
    </div>
@endsection