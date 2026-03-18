@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/info-pages.css') }}">
<div class="info-page">
    <div class="info-page-header">
        <h1>Fast Delivery</h1>
        <p>We aim to get your order to you quickly, safely, and securely.</p>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h2>Processing Time</h2>
            <p>Orders are usually processed within 24 hours, excluding weekends and bank holidays.</p>
        </div>

        <div class="info-card">
            <h2>Standard Delivery</h2>
            <p>Standard UK delivery usually arrives within 2–4 working days.</p>
        </div>

        <div class="info-card">
            <h2>Express Delivery</h2>
            <p>Express delivery options are available at checkout for faster delivery where applicable.</p>
        </div>

        <div class="info-card">
            <h2>Tracking Your Order</h2>
            <p>Once your order has been dispatched, you will receive confirmation and any available tracking details.</p>
        </div>
    </div>
</div>
@endsection