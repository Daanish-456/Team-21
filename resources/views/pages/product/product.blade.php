@extends('layouts.app')
{{-- When possible, change the title of the page to the product name --}}
@section('title', 'Stone & Soul - ' . $product->Product_Name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
@endpush

@section('content')


    <div class="container">
        <img src="{{ $product->Image_URL }}" alt="{{ $product->Product_Name }}" />

        <div class="product-details">
            <h1>{{ $product->Product_Name }}</h1>
            <p>{{ $product->Description }}</p>
            <h2>£{{ $product->Price }}</h2>
            <button class="cart-button btn">Add To Cart</button>
        </div>
    </div>
@endsection