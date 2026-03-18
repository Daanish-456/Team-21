@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/info-pages.css') }}">
<div class="info-page">
    <div class="info-page-header">
        <h1>Frequently Asked Questions</h1>
        <p>Helpful answers to common questions about Stone & Soul.</p>
    </div>

    <div class="info-stack">
        <div class="info-card">
            <h2>How long does delivery take?</h2>
            <p>Standard UK delivery usually takes 2–4 working days.</p>
        </div>

        <div class="info-card">
            <h2>Can I return my order?</h2>
            <p>Yes, returns can be requested within 30 days, subject to our returns conditions.</p>
        </div>

        <div class="info-card">
            <h2>Do I need an account to order?</h2>
            <p>Currently, an account may be required depending on checkout functionality available on the site.</p>
        </div>

        <div class="info-card">
            <h2>How can I contact Stone & Soul?</h2>
            <p>You can contact us through the contact page for any questions or support.</p>
        </div>
    </div>
</div>
@endsection