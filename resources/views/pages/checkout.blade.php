@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
@endpush

@section('content')
    <div class="checkout-wrapper">
        <div class="checkout-card">
            <h1 class="checkout-title">Secure Checkout</h1>
            <p class="checkout-subtitle">Enter your address and card details to complete your order.</p>

            @if (session('success'))
                <div class="checkout-alert checkout-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="checkout-alert checkout-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form id="checkout-form" class="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <div class="form-section">
                    <div class="section-heading">
                        <h2>Delivery Address</h2>
                        <p>Use a full postal address for delivery and billing.</p>
                    </div>

                    <div class="form-group">
                        <label for="address_line_1">Address Line 1</label>
                        <input type="text" id="address_line_1" name="address_line_1"
                            value="{{ old('address_line_1', $addressFields['address_line_1'] ?? '') }}"
                            placeholder="123 Aston Road" required>
                    </div>

                    <div class="form-group">
                        <label for="address_line_2">Address Line 2</label>
                        <input type="text" id="address_line_2" name="address_line_2"
                            value="{{ old('address_line_2', $addressFields['address_line_2'] ?? '') }}"
                            placeholder="Apartment, suite, unit (optional)">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">Town / City</label>
                            <input type="text" id="city" name="city"
                                value="{{ old('city', $addressFields['city'] ?? '') }}"
                                placeholder="Birmingham" required>
                        </div>

                        <div class="form-group">
                            <label for="county">County / State</label>
                            <input type="text" id="county" name="county"
                                value="{{ old('county', $addressFields['county'] ?? '') }}"
                                placeholder="West Midlands">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" id="postcode" name="postcode"
                                value="{{ old('postcode', $addressFields['postcode'] ?? '') }}"
                                placeholder="B4 7ET" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country"
                                value="{{ old('country', $addressFields['country'] ?? 'United Kingdom') }}"
                                placeholder="United Kingdom" required>
                        </div>
                    </div>

                    <label class="checkbox-row" for="save_address">
                        <input type="checkbox" id="save_address" name="save_address" value="1"
                            {{ old('save_address', !empty($user->Address) ? '1' : null) ? 'checked' : '' }}>
                        <span>Save this address to my account for next time</span>
                    </label>
                </div>

                <div class="form-section">
                    <div class="section-heading">
                        <h2>Payment Details</h2>
                        <p>Card details are only used to place this order.</p>
                    </div>

                <div class="form-group">
                    <label for="card_name">Name on Card</label>
                    <input type="text" id="card_name" name="card_name"
                        value="{{ old('card_name', $user->Name ?? '') }}" placeholder="John Smith" required>
                </div>

                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <div class="card-number-wrapper">
                        <input type="text" id="card_number" name="card_number" maxlength="19"
                            value="{{ old('card_number') }}" placeholder="1234 5678 9012 3456" required>
                        <div class="card-logos">
                            <span class="card-chip"></span>
                            <span class="card-brand">VISA</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry">Expiry Date</label>
                        <input type="text" id="expiry" name="expiry" value="{{ old('expiry') }}" placeholder="MM/YY"
                            maxlength="5" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="password" id="cvv" name="cvv" maxlength="4" placeholder="***" required>
                    </div>
                </div>
                </div>

                <button type="submit" class="checkout-btn" data-processing-label="Processing...">
                    Pay Now
                </button>

                <p class="checkout-note">
                    <span class="lock-icon">🔒</span>
                    Your payment information is securely encrypted.
                </p>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('checkout-form').addEventListener('submit', function (e) {
        const button = e.submitter;

        if (!button) {
            return;
        }

        button.disabled = true;
        button.textContent = button.dataset.processingLabel || 'Processing...';
    });
    </script>
@endsection
