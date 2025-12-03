@extends('layouts.app')

@section('title', 'Stone & Soul - Account')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/account.css') }}" />
@endpush

@section('content')
    <div class="account-container">
        <h1>My Account</h1>

        <div class="account-grid">
            {{-- Account Info Section --}}
            <div class="account-section">
                <h2>Account Information</h2>
                <div class="info-card">
                    <div class="info-row">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $user->Name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $user->Email ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $user->Phone ?? 'N/A' }}</span>
                    </div>
                    <button class="edit-btn">Edit Profile</button>
                </div>
            </div>

            {{-- Order History Section - Data from Orders and Order_Item tables --}}
            <div class="account-section full-width">
                <h2>Order History</h2>
                <div class="orders-list">
                    @if(isset($orders) && count($orders) > 0)
                        @foreach($orders as $order)
                            <div class="order-card" data-order-id="{{ $order->OrderID }}">
                                <div class="order-header">
                                    <div>
                                        <span class="order-number">Order #{{ $order->OrderID }}</span>
                                        <span class="order-date">Placed on: {{ date('d M Y', strtotime($order->OrderDate)) }}</span>
                                    </div>
                                    <span
                                        class="order-status {{ strtolower($order->OrderStatus) }}">{{ $order->OrderStatus }}</span>
                                </div>
                                <div class="order-items">
                                    {{-- Backend: Loop through Order_Item WHERE OrderID = $order->OrderID --}}
                                    @if(isset($order->items) && count($order->items) > 0)
                                        @foreach($order->items as $item)
                                            <div class="order-item">
                                                <img src="{{ asset('assets/images/' . ($item->product_image ?? 'example-necklace.png')) }}"
                                                    alt="Product" />
                                                <div>
                                                    <p class="item-name">{{ $item->product_name ?? 'Product' }}</p>
                                                    <p class="item-price">£{{ number_format($item->price, 2) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="order-total">Total: £{{ number_format($order->TotalAmount, 2) }}</div>
                            </div>
                        @endforeach
                    @else
                        <p style="text-align: center; padding: 40px; color: #666;">No orders yet</p>
                    @endif
                </div>
            </div>

            {{-- Addresses Section --}}
            <div class="account-section">
                <h2>Saved Address</h2>
                <div class="address-card">
                    @if($user->Address)
                        <p><strong>Your Address</strong></p>
                        <p>{{ $user->Address }}</p>
                    @else
                        <p>No address saved</p>
                    @endif
                    <button class="edit-btn">Edit</button>
                </div>
            </div>

            {{-- Logout Section --}}
            <div class="account-section">
                <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
@endsection