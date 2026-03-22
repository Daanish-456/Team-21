@extends('layouts.app')

@section('title', 'Checkout — Stone & Soul')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
@endpush

@section('content')
    <div class="checkout-page">
        <div class="checkout-layout">

            {{-- LEFT: Form --}}
            <div class="checkout-form-panel">
                <div class="checkout-steps">
                    <div class="checkout-step checkout-step--active">
                        <span class="step-num">1</span> Delivery
                    </div>
                    <div class="checkout-step-divider"></div>
                    <div class="checkout-step checkout-step--active">
                        <span class="step-num">2</span> Payment
                    </div>
                    <div class="checkout-step-divider"></div>
                    <div class="checkout-step">
                        <span class="step-num">3</span> Confirm
                    </div>
                </div>

                <form id="checkout-form" class="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    {{-- Delivery section --}}
                    <div class="checkout-section">
                        <h2 class="checkout-section-title">Delivery Details</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" id="full_name" name="full_name" placeholder="Jane Smith" class="@error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" required>
                                @error('full_name') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email_addr">Email Address</label>
                                <input type="email" id="email_addr" name="email_addr" placeholder="jane@example.com" class="@error('email_addr') is-invalid @enderror" value="{{ old('email_addr') }}" required>
                                @error('email_addr') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group form-group--full">
                                <label for="address_line">Street Address</label>
                                <input type="text" id="address_line_1" name="address_line_1" placeholder="123 Jewel Street, Birmingham" class="@error('address_line_1') is-invalid @enderror" value="{{ old('address_line_1', $addressFields['address_line_1'] ?? '') }}" required>
                                @error('address_line_1') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="postcode">Postcode</label>
                                <input type="text" id="postcode" name="postcode" placeholder="B1 2AB" class="@error('postcode') is-invalid @enderror" value="{{ old('postcode', $addressFields['postcode'] ?? '') }}" required>
                                @error('postcode') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="Birmingham" class="@error('city') is-invalid @enderror" value="{{ old('city', $addressFields['city'] ?? '') }}" required>
                                @error('city') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Payment section --}}
                    <div class="checkout-section">
                        <h2 class="checkout-section-title">
                            Payment Details
                            <span class="checkout-secure-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                Secure
                            </span>
                        </h2>

                        <div class="checkout-card-icons">
                            <span class="card-logo">VISA</span>
                            <span class="card-logo">MC</span>
                            <span class="card-logo">AMEX</span>
                        </div>

                        <div class="form-group">
                            <label for="card_name">Name on Card</label>
                            <input type="text" id="card_name" name="card_name" placeholder="Jane Smith" class="@error('card_name') is-invalid @enderror" value="{{ old('card_name') }}" required>
                            @error('card_name') <span class="error-text">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <div class="card-input-wrap">
                                <input type="text" id="card_number" name="card_number" maxlength="19"
                                    placeholder="1234 5678 9012 3456" class="@error('card_number') is-invalid @enderror" value="{{ old('card_number') }}" required>
                                <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                            </div>
                            @error('card_number') <span class="error-text">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="expiry">Expiry Date</label>
                                <input type="text" id="expiry" name="expiry" placeholder="MM / YY" maxlength="7" class="@error('expiry') is-invalid @enderror" value="{{ old('expiry') }}" required>
                                @error('expiry') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="cvv">
                                    CVV
                                    <span class="cvv-tip" title="3 digits on the back of your card">?</span>
                                </label>
                                <input type="password" id="cvv" name="cvv" maxlength="4" placeholder="•••" class="@error('cvv') is-invalid @enderror" required>
                                @error('cvv') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="checkout-submit-btn" id="checkoutSubmit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Place Order
                    </button>

                    <p class="checkout-footnote">
                        By placing your order you agree to our <a href="#">Terms of Service</a>.
                        All payments are securely processed.
                    </p>
                </form>
            </div>

            {{-- RIGHT: Order summary sidebar --}}
            <div class="checkout-summary-panel">
                <h2 class="checkout-summary-title">Your Order</h2>

                @php
                    use App\Models\Cart;
                    $userId = session('UserID');
                    $cart = Cart::where('UserID', $userId)->with('items.product')->first();
                    $checkoutItems = $cart ? $cart->items : collect();
                    $subtotal = $checkoutItems->sum(fn($i) => $i->product->Price * $i->Quantity);
                    $shipping = $subtotal >= 50 ? 0 : 3.99;
                    $grandTotal = $subtotal + $shipping;
                @endphp

                <div class="checkout-order-items">
                    @foreach ($checkoutItems as $item)
                        <div class="checkout-order-item">
                            <div class="checkout-item-img-wrap">
                                <img src="{{ asset($item->product->Image_URL) }}" alt="{{ $item->product->Product_Name }}">
                                <span class="checkout-item-qty">{{ $item->Quantity }}</span>
                            </div>
                            <div class="checkout-item-info">
                                <p class="checkout-item-name">{{ $item->product->Product_Name }}</p>
                            </div>
                            <p class="checkout-item-price">£{{ number_format($item->product->Price * $item->Quantity, 2) }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="checkout-summary-rows">
                    <div class="checkout-summary-row">
                        <span>Subtotal</span>
                        <span>£{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="checkout-summary-row">
                        <span>Shipping</span>
                        <span>{{ $shipping == 0 ? 'Free' : '£' . number_format($shipping, 2) }}</span>
                    </div>
                    <div class="checkout-summary-divider"></div>
                    <div class="checkout-summary-row checkout-summary-total">
                        <span>Total</span>
                        <span>£{{ number_format($grandTotal, 2) }}</span>
                    </div>
                </div>

                <div class="checkout-summary-badges">
                    <div class="checkout-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Ethically sourced
                    </div>
                    <div class="checkout-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                        30-day returns
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
// Card number formatting
document.getElementById('card_number').addEventListener('input', function() {
    let v = this.value.replace(/\D/g, '').substring(0, 16);
    this.value = v.match(/.{1,4}/g)?.join(' ') || v;
});
// Expiry formatting
document.getElementById('expiry').addEventListener('input', function() {
    let v = this.value.replace(/\D/g, '').substring(0, 4);
    if (v.length >= 2) v = v.substring(0,2) + ' / ' + v.substring(2);
    this.value = v;
});
// Submit handler
document.getElementById('checkout-form').addEventListener('submit', function() {
    const btn = document.getElementById('checkoutSubmit');
    btn.disabled = true;
    btn.innerHTML = '<span class="checkout-spinner"></span> Processing...';
});
</script>
@endpush