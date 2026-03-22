@extends('layouts.app')

@section('title', 'Stone & Soul - ' . $product->Product_Name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
@endpush

@section('content')
    <div class="product-page">

        {{-- Breadcrumb --}}
        <nav class="product-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('shop') }}">Shop</a>
            <span>›</span>
            <span>{{ $product->Product_Name }}</span>
        </nav>

        <section class="product-layout">
            {{-- Image --}}
            <div class="product-media">
                <div class="product-image-main">
                    <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}" id="mainProductImage" />
                </div>
            </div>

            {{-- Details --}}
            <article class="product-details">

                <p class="product-category-tag">Stone &amp; Soul</p>
                <h1 class="product-name">{{ $product->Product_Name }}</h1>

                <div class="product-rating-row">
                    @php
                        $avgRating = $product->reviews->count() > 0 ? round($product->reviews->avg('Rating'), 1) : 0;
                        $reviewCount = $product->reviews->count();
                    @endphp
                    <span class="product-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= round($avgRating) ? 'star-filled' : 'star-empty' }}">★</span>
                        @endfor
                    </span>
                    <a href="#reviews" class="product-rating-link">{{ $reviewCount }} review{{ $reviewCount !== 1 ? 's' : '' }}</a>
                </div>

                <p class="product-price-hero">£{{ number_format($product->Price, 2) }}</p>

                <p class="product-stock-badge {{ $product->Stock < 1 ? 'is-out' : ($product->Stock < 3 ? 'is-low' : 'is-available') }}">
                    @if ($product->Stock < 1)
                        <span>●</span> Out of stock
                    @elseif ($product->Stock < 3)
                        <span>●</span> Only {{ $product->Stock }} left
                    @else
                        <span>●</span> In stock — ships in 1–3 days
                    @endif
                </p>

                <p class="product-description">{{ $product->Description }}</p>

                <hr class="product-divider">

                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="product-alert product-alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="product-alert product-alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if ($product->Stock > 0)
                    @php
                        $hasRingSizes = $product->ringSizes->isNotEmpty();
                        $hasAvailableRingSizes = ! $hasRingSizes || $product->ringSizes->contains(fn ($ringSize) => (int) $ringSize->Stock > 0);
                        $maxSelectableStock = $hasRingSizes
                            ? max(1, (int) $product->ringSizes->max('Stock'))
                            : max(1, (int) $product->Stock);
                    @endphp
                    <div class="product-purchase-area">
                        <form action="{{ route('cart.add', $product->ProductID) }}" method="POST" class="product-actions">
                            @csrf
                            @if ($hasRingSizes)
                                <div class="product-option-group">
                                    <div class="product-option-header">
                                        <label for="ringSizeSelect" class="product-option-label">Ring size</label>
                                        <a href="{{ route('ring-sizing-guide') }}" class="product-option-link">Sizing guide</a>
                                    </div>
                                    <select
                                        name="size"
                                        id="ringSizeSelect"
                                        class="product-option-select"
                                        required
                                    >
                                        <option value="">Select a size</option>
                                        @foreach ($product->ringSizes as $ringSize)
                                            <option
                                                value="{{ $ringSize->Size }}"
                                                data-stock="{{ $ringSize->Stock }}"
                                                {{ (int) $ringSize->Stock < 1 ? 'disabled' : '' }}
                                            >
                                                {{ $ringSize->Size }}{{ (int) $ringSize->Stock < 1 ? ' · Out of stock' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="product-option-help" id="ringSizeHelp">
                                        Choose your size before adding this ring to the basket.
                                    </p>
                                </div>
                            @endif
                            <div class="product-action-row">
                                <div class="qty-selector">
                                    <button type="button" class="qty-btn" id="qtyMinus" aria-label="Decrease quantity">−</button>
                                    <input type="number" name="quantity" id="qtyInput" value="1" min="1" max="{{ $maxSelectableStock }}" class="qty-input" readonly>
                                    <button type="button" class="qty-btn" id="qtyPlus" aria-label="Increase quantity">+</button>
                                </div>
                                <button
                                    type="submit"
                                    class="product-button product-button-primary"
                                    id="addToBasketButton"
                                    {{ $hasRingSizes && ! $hasAvailableRingSizes ? 'disabled' : '' }}
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                                    {{ $hasRingSizes && ! $hasAvailableRingSizes ? 'No Sizes Available' : 'Add to Basket' }}
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('wishlist.add', $product->ProductID) }}" method="POST" class="product-wishlist-form">
                            @csrf
                            <button type="submit" class="product-button product-button-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                Save to Wishlist
                            </button>
                        </form>
                    </div>
                @else
                    <div class="product-out-of-stock-actions">
                        <button class="product-button product-button-primary" disabled>Out of Stock</button>
                        <form action="{{ route('wishlist.add', $product->ProductID) }}" method="POST" class="product-wishlist-form">
                            @csrf
                            <button type="submit" class="product-button product-button-secondary">Save to Wishlist</button>
                        </form>
                    </div>
                @endif

                {{-- Trust badges --}}
                <div class="product-trust">
                    <div class="trust-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        <span>Free UK delivery over £50</span>
                    </div>
                    <div class="trust-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                        <span>30-day returns</span>
                    </div>
                    <div class="trust-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>Ethically sourced</span>
                    </div>
                </div>

                {{-- Materials & Care Section --}}
                <div class="product-info-collapsible">
                    <details open>
                        <summary>Materials &amp; Care</summary>
                        <div class="collapsible-content">
                            <p>Crafted with recycled sterling silver and 18k gold vermeil. Our stones are ethically sourced and hand-selected for their unique natural textures.</p>
                            <ul>
                                <li>Avoid contact with perfumes and lotions</li>
                                <li>Remove before swimming or exercise</li>
                                <li>Clean gently with a soft, lint-free cloth</li>
                                <li>Store in a cool, dry place when not in use</li>
                            </ul>
                        </div>
                    </details>
                    <details>
                        <summary>Delivery &amp; Returns</summary>
                        <div class="collapsible-content">
                            <p>All orders are processed within 1–3 business days. We offer free standard UK delivery on all orders over £50.</p>
                            <p>If you're not completely satisfied with your purchase, you can return it to us within 30 days for a full refund or exchange.</p>
                        </div>
                    </details>
                </div>
            </article>
        </section>

        {{-- Reviews --}}
        <section class="reviews-section" id="reviews">
            <div class="reviews-header">
                <h2>Customer Reviews</h2>
                @if ($product->reviews->count() > 0)
                    <p class="reviews-summary">
                        <span class="reviews-avg">{{ number_format($avgRating, 1) }}</span>/5
                        · {{ $reviewCount }} review{{ $reviewCount !== 1 ? 's' : '' }}
                    </p>
                @endif
            </div>

            @if ($currentUserId)
                <div class="review-editor">
                    <h3>{{ $userReview ? 'Edit Your Review' : 'Leave a Review' }}</h3>
                    <form action="{{ $userReview ? route('reviews.update', $userReview->ReviewID) : route('reviews.store', $product->ProductID) }}"
                        method="POST" class="review-form">
                        @csrf
                        @if ($userReview) @method('PUT') @endif

                        @if ($errors->any())
                            <div class="product-alert product-alert-error">{{ $errors->first() }}</div>
                        @endif

                        <label>Rating</label>
                        <div class="rating-stars" role="radiogroup" aria-label="Rating">
                            @for ($rating = 5; $rating >= 1; $rating--)
                                <input type="radio" id="rating-{{ $rating }}" name="rating" value="{{ $rating }}"
                                    {{ (int) old('rating', $userReview->Rating ?? 5) === $rating ? 'checked' : '' }} required>
                                <label for="rating-{{ $rating }}" title="{{ $rating }} {{ $rating === 1 ? 'star' : 'stars' }}">★</label>
                            @endfor
                        </div>

                        <label for="comment">Your Comment</label>
                        <textarea id="comment" name="comment" rows="4" maxlength="255" placeholder="Share your thoughts on this piece..." required>{{ old('comment', $userReview->Comment ?? '') }}</textarea>

                        <button type="submit" class="product-button product-button-primary">
                            {{ $userReview ? 'Update Review' : 'Submit Review' }}
                        </button>
                    </form>

                    @if ($userReview)
                        <form action="{{ route('reviews.destroy', $userReview->ReviewID) }}" method="POST" class="review-delete-form">
                            @csrf @method('DELETE')
                            <button type="submit" class="product-button product-button-ghost">Delete Review</button>
                        </form>
                    @endif
                </div>
            @else
                <p class="review-login-prompt">
                    Please <a href="{{ route('login') }}">log in</a> to write a review.
                </p>
            @endif

            <div class="review-list">
                @forelse ($product->reviews as $review)
                    <article class="review-card {{ (int) $currentUserId === (int) $review->UserID ? 'is-own' : '' }}">
                        <div class="review-card-header">
                            <div class="review-avatar">{{ strtoupper(substr($review->user->Name ?? 'A', 0, 1)) }}</div>
                            <div>
                                <strong>{{ $review->user->Name ?? 'Verified Customer' }}</strong>
                                <time datetime="{{ $review->ReviewDate }}">{{ date('d M Y', strtotime($review->ReviewDate)) }}</time>
                            </div>
                            <span class="review-stars">{{ str_repeat('★', (int) $review->Rating) }}{{ str_repeat('☆', 5 - (int) $review->Rating) }}</span>
                        </div>
                        <p class="review-comment">{{ $review->Comment }}</p>
                    </article>
                @empty
                    <p class="review-empty">No reviews yet — be the first to share your thoughts!</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
(function() {
    const minus = document.getElementById('qtyMinus');
    const plus = document.getElementById('qtyPlus');
    const input = document.getElementById('qtyInput');
    const sizeSelect = document.getElementById('ringSizeSelect');
    const addToBasketButton = document.getElementById('addToBasketButton');
    const ringSizeHelp = document.getElementById('ringSizeHelp');
    if (!minus || !plus || !input) return;

    const defaultMax = parseInt(input.getAttribute('max')) || 99;

    const setControlsDisabled = (disabled) => {
        minus.disabled = disabled;
        plus.disabled = disabled;
        input.disabled = disabled;
        if (addToBasketButton) {
            addToBasketButton.disabled = disabled;
        }
    };

    const syncRingSizeState = () => {
        if (!sizeSelect) return;

        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
        const hasSelection = Boolean(sizeSelect.value);

        if (!hasSelection) {
            input.value = 1;
            input.max = 1;
            setControlsDisabled(true);
            if (ringSizeHelp) {
                ringSizeHelp.textContent = 'Choose your size before adding this ring to the basket.';
            }
            return;
        }

        const stock = parseInt(selectedOption.dataset.stock || '1', 10) || 1;
        input.max = stock;
        if (parseInt(input.value, 10) > stock) {
            input.value = stock;
        }
        setControlsDisabled(stock < 1);
        if (ringSizeHelp) {
            ringSizeHelp.textContent = stock > 0
                ? `Size ${sizeSelect.value} has ${stock} available.`
                : `Size ${sizeSelect.value} is out of stock.`;
        }
    };

    if (sizeSelect) {
        syncRingSizeState();
        sizeSelect.addEventListener('change', syncRingSizeState);
    } else {
        input.max = defaultMax;
    }

    minus.addEventListener('click', () => {
        const v = parseInt(input.value);
        if (v > 1) input.value = v - 1;
    });
    plus.addEventListener('click', () => {
        const v = parseInt(input.value);
        const max = parseInt(input.getAttribute('max')) || defaultMax;
        if (v < max) input.value = v + 1;
    });
})();
</script>
@endpush
