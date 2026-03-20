@extends('layouts.app')

@section('content')
<div class="shop-page">

    <h1>Bracelets</h1>
    
    <div class="products-grid">
        @forelse ($products as $product)
            <div class="product-card">
                <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}">
                <h3>{{ $product->Product_Name }}</h3>
                <p>£{{ number_format($product->Price, 2) }}</p>
            </div>
        @empty
            <p>No earrings found.</p>
        @endforelse
    </div>

</div>
@endsection