@extends('layouts.app')

@section('title', 'Stone & Soul - ' . $product->Product_Name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
@endpush

@section('content')
    <div class="product-page">
        <section class="product-layout">
            <div class="product-media">
                <img src="{{ asset($product->Image_URL) }}" alt="{{ $product->Product_Name }}" />
            </div>

            <article class="product-details">
                <h2 class="product-name">{{ $product->Product_Name }}</h2>

                <p class="product-stock {{ $product->Stock < 1 ? 'is-out' : ($product->Stock < 3 ? 'is-low' : 'is-available') }}">
                    @if ($product->Stock < 1)
                        Out of stock
                    @elseif ($product->Stock < 3)
                        Only {{ $product->Stock }} left
                    @else
                        {{ $product->Stock }} in stock
                    @endif
                </p>

                <p class="product-description">{{ $product->Description }}</p>
                <p class="product-price">£{{ number_format($product->Price, 2) }}</p>

                <div class="product-actions">
                    <form action="{{ route('cart.add', $product->ProductID) }}" method="POST" class="product-purchase-form">
                        @csrf

                        @if ($product->ringSizes->isNotEmpty())
                            <div class="product-size-field">
                                <label for="product-size">Choose your ring size</label>
                                <select id="product-size" name="size" class="product-size-select" required>
                                    <option value="">Select a size</option>
                                    @foreach ($product->ringSizes as $ringSize)
                                        <option value="{{ $ringSize->Size }}" {{ old('size') === $ringSize->Size ? 'selected' : '' }}
                                            {{ $ringSize->Stock < 1 ? 'disabled' : '' }}>
                                            {{ $ringSize->Size }}{{ $ringSize->Stock < 1 ? ' · Out of stock' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <button type="submit" class="product-button product-button-primary">
                            Add to Cart
                        </button>
                    </form>

                    <form action="{{ route('wishlist.add', $product->ProductID) }}" method="POST" class="product-wishlist-form">
                        @csrf
                        <button type="submit" class="product-button product-button-secondary">
                            Add to Wishlist
                        </button>
                    </form>
                </div>
            </article>
        </section>

        <section class="reviews-section" id="reviews">
            <div class="reviews-header">
                <h3>Customer Reviews</h3>
                @if ($product->reviews->count() > 0)
                    <p>
                        {{ $product->reviews->count() }} review{{ $product->reviews->count() === 1 ? '' : 's' }}
                        · Average {{ number_format((float) $product->reviews->avg('Rating'), 1) }}/5
                    </p>
                @else
                    <p>No reviews yet.</p>
                @endif
            </div>

            @if (session('success'))
                <p class="review-alert">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="review-alert review-alert-error">{{ session('error') }}</p>
            @endif

            @if ($errors->any())
                <div class="review-alert review-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            @if ($currentUserId)
                <div class="review-editor">
                    <h4>{{ $userReview ? 'Edit Your Review' : 'Leave a Review' }}</h4>

                    <form action="{{ $userReview ? route('reviews.update', $userReview->ReviewID) : route('reviews.store', $product->ProductID) }}"
                        method="POST" class="review-form">
                        @csrf
                        @if ($userReview)
                            @method('PUT')
                        @endif

                        <label>Rating</label>
                        <div class="rating-stars" role="radiogroup" aria-label="Rating">
                            @for ($rating = 5; $rating >= 1; $rating--)
                                <input type="radio" id="rating-{{ $rating }}" name="rating" value="{{ $rating }}"
                                    {{ (int) old('rating', $userReview->Rating ?? 5) === $rating ? 'checked' : '' }} required>
                                <label for="rating-{{ $rating }}" title="{{ $rating }} {{ $rating === 1 ? 'star' : 'stars' }}"
                                    aria-label="{{ $rating }} {{ $rating === 1 ? 'star' : 'stars' }}">★</label>
                            @endfor
                        </div>

                        <label for="comment">Comment</label>
                        <textarea id="comment" name="comment" rows="4" maxlength="255" required>{{ old('comment', $userReview->Comment ?? '') }}</textarea>

                        <button type="submit" class="product-button product-button-primary">
                            {{ $userReview ? 'Update Review' : 'Submit Review' }}
                        </button>
                    </form>

                    @if ($userReview)
                        <form action="{{ route('reviews.destroy', $userReview->ReviewID) }}" method="POST" class="review-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="product-button product-button-secondary">Delete Review</button>
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
                            <strong>{{ $review->user->Name ?? 'Verified Customer' }}</strong>
                            <span>{{ str_repeat('★', (int) $review->Rating) }}{{ str_repeat('☆', 5 - (int) $review->Rating) }}</span>
                        </div>
                        <time datetime="{{ $review->ReviewDate }}">{{ date('d M Y', strtotime($review->ReviewDate)) }}</time>
                        <p>{{ $review->Comment }}</p>
                    </article>
                @empty
                    <p class="review-empty">Be the first to review this product.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
