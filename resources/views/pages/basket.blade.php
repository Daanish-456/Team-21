@extends('layouts.app')

@section('title', 'Stone & Soul - Cart')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/basket.css') }}" />
@endpush

@section('content')
    <div class="basket-container">
        <h1>Your Cart</h1>

        <div class="basket-content">
            {{-- Empty cart message (hide when items exist) --}}
            <div class="empty-basket" id="empty-basket" style="display: none;">
                <p>Your cart is empty</p>
                <a href="{{ route('shop') }}" class="continue-shopping">Continue Shopping</a>
            </div>

            {{-- Cart items (backend will populate from Cart and Cart_Item tables) --}}
            <div class="basket-items" id="basket-items">
                <!--       {{-- Example item 1 - Backend will loop through Cart_Item table --}}
                            <div class="basket-item" data-price="89.99" data-cart-item-id="1">
                                <img src="{{ asset('assets/images/example-necklace.png') }}" alt="Product" class="basket-item-image" />
                                <div class="basket-item-details">
                                    <h3 class="basket-item-name">Silver Moon Necklace</h3>
                                    <p class="basket-item-price">£89.99</p>
                                </div>
                                <div class="basket-item-quantity">
                                    <button class="qty-btn minus">-</button>
                                    <input type="number" value="1" min="1" class="qty-input" />
                                    <button class="qty-btn plus">+</button>
                                </div>
                                <div class="basket-item-total">
                                    <p class="item-total">£89.99</p>
                                </div>
                                <button class="remove-btn">Remove</button>
                            </div>

                            {{-- Example item 2 - Backend will loop through Cart_Item table --}}
                            <div class="basket-item" data-price="129.99" data-cart-item-id="2">
                                <img src="{{ asset('assets/images/example-necklace.png') }}" alt="Product" class="basket-item-image" />
                                <div class="basket-item-details">
                                    <h3 class="basket-item-name">Rose Gold Pendant</h3>
                                    <p class="basket-item-price">£129.99</p>
                                </div>
                                <div class="basket-item-quantity">
                                    <button class="qty-btn minus">-</button>
                                    <input type="number" value="2" min="1" class="qty-input" />
                                    <button class="qty-btn plus">+</button>
                                </div>
                                <div class="basket-item-total">
                                    <p class="item-total">£259.98</p>
                                </div>
                                <button class="remove-btn">Remove</button>
                            </div>
                        </div>  
                        -->

                {{-- Cart summary --}}
                <div class="basket-summary" id="basket-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="subtotal">£0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span id="total">£0.00</span>
                    </div>
                    <a href="{{ route('home') }}" class="checkout-btn">Proceed to Checkout</a>
                </div>
            </div>
        </div>
@endsection

    @push('scripts')
        <script>
            // Calculate totals based on Cart_Item entries
            function updateTotals() {
                let subtotal = 0;

                document.querySelectorAll('.basket-item').forEach(item => {
                    const price = parseFloat(item.getAttribute('data-price'));
                    const quantity = parseInt(item.querySelector('.qty-input').value);
                    const itemTotal = price * quantity;

                    // Update item total display
                    item.querySelector('.item-total').textContent = '£' + itemTotal.toFixed(2);

                    // Add to subtotal
                    subtotal += itemTotal;
                });

                // Update subtotal and total
                document.getElementById('subtotal').textContent = '£' + subtotal.toFixed(2);
                document.getElementById('total').textContent = '£' + subtotal.toFixed(2);
            }

            // Quantity adjustment functionality
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const input = this.parentElement.querySelector('.qty-input');
                    const currentValue = parseInt(input.value);
                    const cartItemId = this.closest('.basket-item').getAttribute('data-cart-item-id');

                    if (this.classList.contains('plus')) {
                        input.value = currentValue + 1;
                    } else if (this.classList.contains('minus') && currentValue > 1) {
                        input.value = currentValue - 1;
                    }

                    updateTotals();

                    // Backend team: Send AJAX request to update Cart_Item quantity in database
                    // Example: updateCartItemQuantity(cartItemId, input.value);
                });
            });

            // Allow manual input changes
            document.querySelectorAll('.qty-input').forEach(input => {
                input.addEventListener('change', function () {
                    if (parseInt(this.value) < 1) {
                        this.value = 1;
                    }
                    const cartItemId = this.closest('.basket-item').getAttribute('data-cart-item-id');
                    updateTotals();

                    // Backend team: Send AJAX request to update Cart_Item quantity in database
                    // Example: updateCartItemQuantity(cartItemId, this.value);
                });
            });

            // Remove item functionality
            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const cartItemId = this.closest('.basket-item').getAttribute('data-cart-item-id');

                    // Backend team: Send AJAX request to delete from Cart_Item table
                    // Example: deleteCartItem(cartItemId);

                    this.closest('.basket-item').remove();
                    updateTotals();

                    // Check if cart is empty
                    if (document.querySelectorAll('.basket-item').length === 0) {
                        document.getElementById('empty-basket').style.display = 'block';
                        document.getElementById('basket-items').style.display = 'none';
                        document.getElementById('basket-summary').style.display = 'none';
                    }
                });
            });

            // Initialize totals on page load
            updateTotals();
        </script>
    @endpush