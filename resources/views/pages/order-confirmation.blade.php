@extends('layouts.app')

@section('title', 'Order Confirmed')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/order-confirmation.css') }}">
@endpush

@section('content')
    @php
        $displayTotal = (float) $order->TotalAmount;
        if ($displayTotal <= 0) {
            $displayTotal = (float) $order->items->sum(function ($item) {
                return (float) $item->Price * (int) $item->Quantity;
            });
        }
    @endphp

    <div class="confirmation-wrapper">
        <div class="confirmation-card">
            {{-- Success Icon --}}
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>

            <h1 class="confirmation-title">Order Confirmed!</h1>
            <p class="confirmation-subtitle">Thank you for your purchase</p>

            {{-- Order Details --}}
            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Order Number:</span>
                    <span class="detail-value">#{{ $order->OrderID }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Order Date:</span>
                    <span class="detail-value">{{ date('d M Y, H:i', strtotime($order->OrderDate)) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value total-amount">£{{ number_format($displayTotal, 2) }}</span>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="order-items-section">
                <h3>Items Ordered</h3>
                <div class="order-items-list">
                    @foreach($order->items as $item)
                        <div class="order-item">
                            <div class="item-info">
                                <p class="item-name">{{ $item->product->Product_Name }}</p>
                                <p class="item-qty">Qty: {{ $item->Quantity }}</p>
                                @if (!empty($item->Size))
                                    <p class="item-qty">Size: {{ $item->Size }}</p>
                                @endif
                            </div>
                            <p class="item-price">£{{ number_format($item->Price * $item->Quantity, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Next Steps --}}
            <div class="next-steps">
                <p class="next-steps-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    A confirmation email has been sent to your registered email address.
                </p>
            </div>

            {{-- Action Buttons --}}
            <div class="confirmation-actions">
                <a href="{{ route('account') }}" class="btn-secondary">View My Orders</a>
                <a href="{{ route('shop') }}" class="btn-primary">Continue Shopping</a>
            </div>
        </div>
    </div>
@endsection
