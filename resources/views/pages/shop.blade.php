@extends('layouts.app')

@section('title', 'Stone & Soul - Shop')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
@endpush

@section('content')
    <section class="shop-results">
        @if(isset($query))
            <h2>Search results for "{{ $query }}"</h2>

            <div class="product-track">
                @forelse($products as $product)
                    <article class="product-card">
                        <div class="product-image-wrapper">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-price">£{{ $product->price }}</p>
                            <p class="product-tagline">{{ $product->tagline }}</p>
                        </div>
                    </article>
                @empty
                    <p>No products found matching your search.</p>
                @endforelse
            </div>
        @endif
    </section>



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
                    @foreach ($products as $product)
                        @if ($product->CategoryID == 1)
                            <a href="/product/{{$product->ProductID}}">
                                <article class="product-card" data-name="{{ $product->Product_Name }}"
                                    data-price="{{ $product->Price }}" data-description="{{ $product->Description }}"
                                    data-image="{{ asset($product->Image_URL) }}">
                                    <div class="product-image-wrapper">
                                        <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}">
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title">{{ $product->Product_Name }}</h3>
                                        <p class="product-price">£{{ number_format($product->Price, 2) }}</p>
                                        <p class="product-tagline">{{ $product->Description }}</p>
                                    </div>
                                </article>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll necklaces right">
                    ›
                </button>
            </div>
        </section>

        <section class="category-block" id="earrings">
            <div class="category-header">
                <div>
                    <h2>Earrings</h2>
                    <p>Stackable chains and beadwork for every day.</p>
                </div>
            </div>

            <div class="product-scroller" data-category="earrings">
                <button class="scroll-btn scroll-btn-left" aria-label="Scroll bracelets left">
                    ‹
                </button>

                <div class="product-track">
                    @foreach ($products as $product)
                        @if ($product->CategoryID == 2)
                            <a href="/product/{{$product->ProductID}}">
                                <article class="product-card" data-name="{{ $product->Product_Name }}"
                                    data-price="{{ $product->Price }}" data-description="{{ $product->Description }}"
                                    data-image="{{ asset($product->Image_URL) }}">
                                    <div class="product-image-wrapper">
                                        <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}">
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title">{{ $product->Product_Name }}</h3>
                                        <p class="product-price">£{{ number_format($product->Price, 2) }}</p>
                                        <p class="product-tagline">{{ $product->Description }}</p>
                                    </div>
                                </article>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll bracelets right">
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

            <div class="product-scroller" data-category="rings">
                <button class="scroll-btn scroll-btn-left" aria-label="Scroll rings left">
                    ‹
                </button>

                <div class="product-track">
                    @foreach ($products as $product)
                        @if ($product->CategoryID == 3)
                            <a href="/product/{{$product->ProductID}}">
                                <article class="product-card" data-name="{{ $product->Product_Name }}"
                                    data-price="{{ $product->Price }}" data-description="{{ $product->Description }}"
                                    data-image="{{ asset($product->Image_URL) }}">
                                    <div class="product-image-wrapper">
                                        <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}">
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title">{{ $product->Product_Name }}</h3>
                                        <p class="product-price">£{{ number_format($product->Price, 2) }}</p>
                                        <p class="product-tagline">{{ $product->Description }}</p>
                                    </div>
                                </article>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll rings right">
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
                    @foreach ($products as $product)
                        @if ($product->CategoryID == 4)
                            <a href="/product/{{$product->ProductID}}">
                                <article class="product-card" data-name="{{ $product->Product_Name }}"
                                    data-price="{{ $product->Price }}" data-description="{{ $product->Description }}"
                                    data-image="{{ asset($product->Image_URL) }}">
                                    <div class="product-image-wrapper">
                                        <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}">
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title">{{ $product->Product_Name }}</h3>
                                        <p class="product-price">£{{ number_format($product->Price, 2) }}</p>
                                        <p class="product-tagline">{{ $product->Description }}</p>
                                    </div>
                                </article>
                            </a>
                        @endif
                    @endforeach
                </div>

                <button class="scroll-btn scroll-btn-right" aria-label="Scroll rings right">
                    ›
                </button>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const params = new URLSearchParams(window.location.search);
            const query = (params.get('q') || '').trim().toLowerCase();
            if (!query) return;

            // Add a search results header
            const hero = document.querySelector('.shop-hero');
            if (hero) {
                const header = document.createElement('div');
                header.className = 'category-header';
                header.innerHTML = `<h2>Search results for "${query}"</h2>`;
                hero.insertAdjacentElement('afterend', header);
            }

            let totalMatches = 0;
            document.querySelectorAll('.product-card').forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                const description = (card.dataset.description || '').toLowerCase();
                const match = name.includes(query) || description.includes(query);
                card.style.display = match ? '' : 'none';
                if (match) totalMatches++;
            });

            // Hide empty category blocks
            document.querySelectorAll('.category-block').forEach(block => {
                const visibleCards = block.querySelectorAll('.product-card:not([style*="display: none"])');
                if (visibleCards.length === 0) block.style.display = 'none';
            });

            if (totalMatches === 0) {
                const msg = document.createElement('p');
                msg.textContent = 'No products found matching your search.';
                document.querySelector('.shop-page').appendChild(msg);
            }
        })();
    </script>
    <script src="{{ asset('assets/js/shop.js') }}"></script>
@endpush