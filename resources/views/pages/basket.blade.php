@extends('layouts.app')

@section('title', 'Your Basket')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/basket.css') }}">
@endpush

@section('content')
    <div class="basket-container">
        <h1 class="basket-title">Your Basket</h1>

        @if (session('success'))
            <p class="basket-alert">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="basket-alert basket-alert-error">{{ session('error') }}</p>
        @endif

        @if ($items->isEmpty())
            <p class="basket-empty">Your basket is empty.</p>
        @else
            @php $total = 0; @endphp

            <table class="basket-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        @php
                            $lineTotal = $item->product->Price * $item->Quantity;
                            $total += $lineTotal;
                        @endphp

                        <tr>
                            <td class="basket-product">
                                <a href="{{ route('product', $item->ProductID) }}">
                                    <strong>{{ $item->product->Product_Name }}</strong>
                                </a>
                            </td>

                            <td>£{{ number_format($item->product->Price, 2) }}</td>

                            {{-- Update Quantity --}}
                            <td>
                                <form action="{{ route('cart.update', $item->ProductID) }}" method="POST"
                                    class="basket-inline-form">
                                    @csrf
                                    <input type="number" name="quantity" min="1" value="{{ $item->Quantity }}"
                                        class="basket-qty-input">
                                    <button type="submit" class="basket-btn basket-btn-secondary">Update</button>
                                </form>
                            </td>

                            <td>£{{ number_format($lineTotal, 2) }}</td>

                            {{-- Remove Item --}}
                            <td>
                                <form action="{{ route('cart.remove', $item->ProductID) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="basket-btn basket-btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="3" class="basket-total-label">Total:</th>
                        <th>£{{ number_format($total, 2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>

            {{-- Checkout Button --}}
            <div class="basket-checkout-row">
                <a href="{{ route('checkout') }}" class="basket-btn basket-btn-primary">
                    Proceed to Checkout
                </a>
            </div>

        @endif
    </div>
@endsection