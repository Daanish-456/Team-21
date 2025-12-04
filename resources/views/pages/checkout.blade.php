@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
@endpush

@section('content')
    <div class="checkout-wrapper">
        <div class="checkout-card">
            <h1 class="checkout-title">Secure Checkout</h1>
            <p class="checkout-subtitle">Enter your card details to complete your order.</p>

            <form id="checkout-form" class="checkout-form">
                @csrf

                <div class="form-group">
                    <label for="card_name">Name on Card</label>
                    <input type="text" id="card_name" name="card_name" placeholder="Zainab Mazahir" required>
                </div>

                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <div class="card-number-wrapper">
                        <input type="text" id="card_number" name="card_number" maxlength="19"
                               placeholder="1234 5678 9012 3456" required>
                        <div class="card-logos">
                            <span class="card-chip"></span>
                            <span class="card-brand">VISA</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry">Expiry Date</label>
                        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="password" id="cvv" name="cvv" maxlength="4" placeholder="***" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="billing_address">Billing Address</label>
                    <input type="text" id="billing_address" name="billing_address"
                           placeholder="123 Aston Road, Birmingham" required>
                </div>

                <button type="submit" class="checkout-btn">
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
            e.preventDefault();

            const button = this.querySelector('.checkout-btn');
            button.disabled = true;
            button.textContent = 'Processing...';

            setTimeout(function () {
                alert('Order placed successfully! 🎉');
                window.location.href = "{{ route('basket') }}";
            }, 800);
        });
    </script>
@endsection
