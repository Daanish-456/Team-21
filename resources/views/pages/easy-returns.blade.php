@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/info-pages.css') }}">
<div class="info-page">
    <div class="info-page-header">
        <h1>Easy Returns & Exchanges</h1>
        <p>We want you to shop with confidence and peace of mind every time you order from Stone & Soul.</p>
    </div>

    <div class="info-stack">
        <div class="info-card">
            <h2>30-Day Returns</h2>
            <p>You can request a return within 30 days of receiving your order.</p>
        </div>

        <div class="info-card">
            <h2>Return Conditions</h2>
            <ul>
                <li>Items must be unworn and in their original condition</li>
                <li>Original packaging should be included</li>
                <li>Proof of purchase is required</li>
            </ul>
        </div>

        <div class="info-card">
            <h2>How to Return</h2>
            <ol>
                <li>Contact our support team with your order details</li>
                <li>Follow the return instructions provided</li>
                <li>Send the item back using the return information</li>
            </ol>
        </div>

        <div class="info-card">
            <h2>Refunds & Exchanges</h2>
            <p>Once your return has been received and checked, refunds are processed back to your original payment method. If you would prefer an exchange, our team will be happy to help.</p>
        </div>
    </div>
</div>
@endsection