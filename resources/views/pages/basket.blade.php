@extends('layouts.app')

@section('title', 'Your Basket — Stone & Soul')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/basket.css') }}">
@endpush

@section('content')
    <div class="basket-page">
        <div class="basket-header">
            <h1>Your Basket</h1>
            @if (!$items->isEmpty())
                <a href="{{ route('shop') }}" class="basket-continue-link">← Continue shopping</a>
            @endif
        </div>

        @if (session('success'))
            <div class="basket-flash basket-flash-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="basket-flash basket-flash-error">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($items->isEmpty())
            <div class="basket-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                <h2>Your basket is empty</h2>
                <p>Looks like you haven't added any pieces yet.</p>
                <a href="{{ route('shop') }}" class="basket-shop-btn">Browse jewellery</a>
            </div>
        @else
            @php $total = 0; @endphp

            <div class="basket-layout">
                {{-- Left: items --}}
                <div class="basket-items">
                    @foreach ($items as $item)
                        @php
                            $lineTotal = $item->product->Price * $item->Quantity;
                            $total += $lineTotal;
                        @endphp

                        <div class="basket-item">
                            <a href="{{ route('product', $item->ProductID) }}" class="basket-item-image">
                                <img src="{{ asset($item->product->Image_URL) }}" alt="{{ $item->product->Product_Name }}">
                            </a>

                            <div class="basket-item-info">
                                <a href="{{ route('product', $item->ProductID) }}" class="basket-item-name">{{ $item->product->Product_Name }}</a>
                                <p class="basket-item-unit">£{{ number_format($item->product->Price, 2) }} each</p>

                                <form action="{{ route('cart.update', $item->ProductID) }}" method="POST" class="basket-qty-form">
                                    @csrf
                                    <div class="basket-qty-row">
                                        <div class="qty-selector">
                                            <button type="button" class="qty-btn basket-qty-minus" aria-label="Decrease">−</button>
                                            <input type="number" name="quantity" value="{{ $item->Quantity }}" min="1" max="{{ $item->product->Stock }}" class="qty-input basket-qty-input" readonly>
                                            <button type="button" class="qty-btn basket-qty-plus" aria-label="Increase">+</button>
                                        </div>
                                        <button type="submit" class="basket-update-btn">Update</button>
                                    </div>
                                </form>
                            </div>

                            <div class="basket-item-right">
                                <p class="basket-item-subtotal">£{{ number_format($lineTotal, 2) }}</p>
                                <form action="{{ route('cart.remove', $item->ProductID) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="basket-remove-btn" aria-label="Remove item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Right: order summary --}}
                <div class="basket-summary">
                    <h2 class="summary-title">Order Summary</h2>

                    <div class="summary-rows">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>£{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>{{ $total >= 50 ? 'Free' : '£3.99' }}</span>
                        </div>
                        @if ($total < 50)
                        <div class="summary-shipping-note">
                            Add £{{ number_format(50 - $total, 2) }} more for free UK delivery
                        </div>
                        @endif
                        <div class="summary-divider"></div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span>£{{ number_format($total < 50 ? $total + 3.99 : $total, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" class="basket-checkout-btn">
                        Proceed to Checkout
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>

                    <div class="summary-trust">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Secure, encrypted checkout
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.basket-qty-minus').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('.basket-qty-input');
        const v = parseInt(input.value);
        if (v > 1) input.value = v - 1;
    });
});
document.querySelectorAll('.basket-qty-plus').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('.basket-qty-input');
        const max = parseInt(input.getAttribute('max')) || 99;
        const v = parseInt(input.value);
        if (v < max) input.value = v + 1;
    });
});
</script>
@endpush