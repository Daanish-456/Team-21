@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/info-pages.css') }}">

<div class="info-page">
    <div class="info-page-header">
        <h1>Our Commitment to Ethical Sourcing</h1>
        <p>At Stone & Soul, we believe jewellery should be beautiful, meaningful, and responsibly made.</p>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h2>Responsible Materials</h2>
            <p>We carefully select materials that reflect our values of quality, responsibility, and longevity. Wherever possible, we prioritise recycled metals, responsibly sourced stones, and lower-impact production methods.</p>
        </div>

        <div class="info-card">
            <h2>Fair Production</h2>
            <p>We aim to work with suppliers who value fair working conditions, skilled craftsmanship, and safe environments. Every piece should be made with care and respect.</p>
        </div>

        <div class="info-card">
            <h2>Sustainability Matters</h2>
            <p>We are committed to reducing environmental impact through mindful design choices, recyclable packaging, and more conscious production practices as our brand grows.</p>
        </div>

        <div class="info-card">
            <h2>Transparency</h2>
            <p>Ethical sourcing is an ongoing journey. We are committed to learning, improving, and being open with our customers about the values behind our collections.</p>
        </div>
    </div>
</div>
@endsection