@extends('layouts.app')

@section('title', 'Stone & Soul - Shop')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endpush

@section('content')
    <div class="shop-page">
        <section class="shop-hero">
            <h1>Shop Jewellery</h1>
            <p>Explore our curated collection of necklaces, bracelets and rings crafted with intention.</p>
        </section>

        <section class="category-block" id="necklaces">
            <div class="category-header">
                <div>
                    <h2>Necklaces</h2>
                    <p>Layerable chains, pendants and statement pieces.</p>
                </div>
            </div>

            <div class="product-scroller" data-category="necklaces">
                <button class="scroll-btn scroll-btn-left" aria-label="Scroll necklaces left">
                    ‹
                </button>

                <div class="product-track">

                    <article class="product-card" data-name="Luna Moon Pendant" data-price="£45.00"
                        data-description="Delicate moon pendant on a fine gold-plated chain, perfect for everyday layering."
                        data-image="{{ asset('assets/images/shop/necklaces/luna-moon.png') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/necklaces/luna-moon.png') }}"
                                alt="Luna Moon Pendant necklace">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Luna Moon Pendant</h3>
                            <p class="product-price">£45.00</p>
                            <p class="product-tagline">Subtle glow. Everyday magic.</p>
                        </div>
                    </article>

                    <article class="product-card" data-name="Soulstone Bar Necklace" data-price="£52.00"
                        data-description="A minimalist bar necklace set with a single ethically-sourced crystal."
                        data-image="{{ asset('assets/images/shop/necklaces/soulstone-bar.png') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/necklaces/soulstone-bar.png') }}"
                                alt="Soulstone Bar Necklace">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Soulstone Bar Necklace</h3>
                            <p class="product-price">£52.00</p>
                            <p class="product-tagline">Minimal lines, maximum meaning.</p>
                        </div>
                    </article>

                    <article class="product-card" data-name="Aura Coin Necklace" data-price="£60.00"
                        data-description="Hand-hammered coin pendant symbolising protection and clarity."
                        data-image="{{ asset('assets/images/shop/necklaces/aura-coin.jpg') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/necklaces/aura-coin.jpg') }}" alt="Aura Coin Necklace">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Aura Coin Necklace</h3>
                            <p class="product-price">£60.00</p>
                            <p class="product-tagline">Protective, timeless, intentional.</p>
                        </div>
                    </article>
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll necklaces right">
                    ›
                </button>
            </div>
        </section>

        <section class="category-block" id="bracelets">
            <div class="category-header">
                <div>
                    <h2>Bracelets</h2>
                    <p>Stackable chains and beadwork for every day.</p>
                </div>
            </div>

            <div class="product-scroller" data-category="bracelets">
                <button class="scroll-btn scroll-btn-left" aria-label="Scroll bracelets left">
                    ‹
                </button>

                <div class="product-track">

                    <article class="product-card" data-name="Harmony Bead Bracelet" data-price="£35.00"
                        data-description="Hand-strung gemstones chosen to promote balance and calm."
                        data-image="{{ asset('assets/images/shop/bracelets/harmony-bead.png') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/bracelets/harmony-bead.png') }}"
                                alt="Harmony Bead Bracelet">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Harmony Bead Bracelet</h3>
                            <p class="product-price">£35.00</p>
                            <p class="product-tagline">Grounded energy on your wrist.</p>
                        </div>
                    </article>

                    <article class="product-card" data-name="Serenity Chain Bracelet" data-price="£40.00"
                        data-description="Fine chain bracelet with subtle textured links for a soft shimmer."
                        data-image="{{ asset('assets/images/shop/bracelets/serenity-chain.png') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/bracelets/serenity-chain.png') }}"
                                alt="Serenity Chain Bracelet">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Serenity Chain Bracelet</h3>
                            <p class="product-price">£40.00</p>
                            <p class="product-tagline">Delicate shine, everyday wear.</p>
                        </div>
                    </article>

                    <article class="product-card" data-name="Soul Cuff" data-price="£58.00"
                        data-description="Adjustable cuff bracelet with a softly brushed finish."
                        data-image="{{ asset('assets/images/shop/bracelets/soul-cuff.png') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/bracelets/soul-cuff.png') }}" alt="Soul Cuff">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Soul Cuff</h3>
                            <p class="product-price">£58.00</p>
                            <p class="product-tagline">Sculpted to sit softly on the wrist.</p>
                        </div>
                    </article>
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll bracelets right">
                    ›
                </button>
            </div>
        </section>

        <section class="category-block" id="rings">
            <div class="category-header">
                <div>
                    <h2>Rings</h2>
                    <p>Stacks, solitaires and statement pieces.</p>
                </div>
            </div>

            <div class="product-scroller" data-category="rings">
                <button class="scroll-btn scroll-btn-left" aria-label="Scroll rings left">
                    ‹
                </button>

                <div class="product-track">

                    <article class="product-card" data-name="Eclipse Stacking Ring" data-price="£30.00"
                        data-description="Slim band finished with a subtle hammered texture, perfect for stacking."
                        data-image="{{ asset('assets/images/shop/rings/eclipse-stack.jpg') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/rings/eclipse-stack.jpg') }}"
                                alt="Eclipse Stacking Ring">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Eclipse Stacking Ring</h3>
                            <p class="product-price">£30.00</p>
                            <p class="product-tagline">Build your own constellation.</p>
                        </div>
                    </article>

                    <article class="product-card" data-name="Solace Gemstone Ring" data-price="£55.00"
                        data-description="Single gemstone ring in a classic claw setting."
                        data-image="{{ asset('assets/images/shop/rings/solace-gemstone.png') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/rings/solace-gemstone.png') }}"
                                alt="Solace Gemstone Ring">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Solace Gemstone Ring</h3>
                            <p class="product-price">£55.00</p>
                            <p class="product-tagline">A focal point with quiet power.</p>
                        </div>
                    </article>

                    <article class="product-card" data-name="Orbit Signet Ring" data-price="£65.00"
                        data-description="A modern signet ring with softly rounded edges."
                        data-image="{{ asset('assets/images/shop/rings/orbit-signet.jpg') }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset('assets/images/shop/rings/orbit-signet.jpg') }}" alt="Orbit Signet Ring">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Orbit Signet Ring</h3>
                            <p class="product-price">£65.00</p>
                            <p class="product-tagline">Bold, but still wearable daily.</p>
                        </div>
                    </article>
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll rings right">
                    ›
                </button>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/shop.js') }}"></script>
@endpush