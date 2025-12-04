@extends('layouts.app')

@section('title', 'Stone & Soul - About')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
    <div class="about-page">

        <section class="about-hero">
            <div class="about-hero-inner">
                <h1>About Stone &amp; Soul</h1>
                <p>
                Ethically Sourced. Soulfully Crafted.
                Discover jewellery that honors the earth and elevates your spirit.
                </p>
            </div>
        </section>

        <section class="about-section about-story">
            <div class="about-section-text">
                <h2>Our Story</h2>
                <p>
                    Stone &amp; Soul was born from the idea that timeless jewellery should never come at the
                    cost of people or the planet. We create pieces designed to be loved and passed on and carry value,
                    whilst using carefully sourced materials and mindful production during the process.
                </p>
                <p>
                    Every collection is chosen specially and taken with deep thought from the first sketch to the final product.
                    We focus on beautiful and effortless design, soft textures and everyday pieces that layer effortlessly
                    into your own style fitting all needs. 
                </p>
            </div>
            <div class="about-section-media">
                <img src="{{ asset('assets/images/logo.png') }}"
                     alt="Stone & Soul Jewellery logo"
                     class="about-logo-image">
            </div>
        </section>


        <section class="about-section about-values">
            <header class="about-section-header">
                <h2>What We Stand For As A Company</h2>
                <p>Our Core Values:</p>
            </header>

            <div class="values-grid">
                <article class="value-card">
                    <h3>Ethical Sourcing</h3>
                    <p>
                        We partner with suppliers who share our commitment to fair labour and transparent supply
                        chains, prioritising recycled metals and responsibly sourced stones.
                    </p>
                </article>

                <article class="value-card">
                    <h3>Considered Design</h3>
                    <p>
                        Our pieces are made to be worn on repeat with versatile silhouettes, comfortable fits and
                        subtle details that work from day to night, season after season.
                    </p>
                </article>

                <article class="value-card">
                    <h3>Lasting Quality</h3>
                    <p>
                        We focus on finishes and materials that stand up to everyday wear, so your jewellery feels
                        special and worth it, because you are worth it.
                    </p>
                </article>
            </div>
        </section>

        <section class="about-section about-materials">
            <div class="about-section-text">
                <h2>Materials &amp; Making</h2>
                <p>
                    From recycled sterling silver to gold-plated brass and hand-cut gemstones, every material we use
                    is chosen with both beauty and responsibility in mind. We work in small batches to reduce waste
                    and to keep a close eye on quality.
                </p>
                <p>
                    Each piece passes through careful quality checks from setting stones to smoothing edges so it
                    arrives ready to become part of your everyday ritual.
                </p>
            </div>

            <div class="about-section-highlights">
                <div class="highlight-pill">
                    <span>• Recycled metals where possible</span>
                </div>
                <div class="highlight-pill">
                    <span>• Small-batch production</span>
                </div>
                <div class="highlight-pill">
                    <span>• Nickel-safe finishes</span>
                </div>
            </div>
        </section>

        <section class="about-section about-cta">
            <div class="about-cta-inner">
                <h2>Wear Your Values</h2>
                <p>
                    Explore pieces that feel as good as they look thoughtfully designed, carefully made and
                    created to be part of your everyday story.
                </p>
                <a href="{{ route('shop') }}" class="about-cta-link">
                    Shop the collection
                </a>
            </div>
        </section>
    </div>
@endsection
