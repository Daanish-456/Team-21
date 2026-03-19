@extends('layouts.app')

@section('title', 'Stone & Soul - Order #'.$order['id'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin-order-show.css') }}">
@endpush

@section('content')
    <div class="admin-orders-page">
        <section class="admin-orders-hero">
            <div>
                <p class="admin-orders-kicker">Order Detail</p>
                <h1>Order #{{ $order['id'] }}</h1>
                <p class="admin-orders-subtitle">
                    Placed {{ $order['placed_at']->format('d M Y, H:i') }} by {{ $order['customer_name'] }}.
                </p>
            </div>

            <div class="admin-order-hero-actions">
                <a href="{{ route('admin.orders') }}" class="admin-orders-link">Back to orders</a>
            </div>
        </section>

        @if (session('success'))
            <div class="admin-orders-alert admin-orders-alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="admin-orders-alert admin-orders-alert-error">{{ $errors->first() }}</div>
        @endif

        <article class="admin-order-card">
            <div class="admin-order-card-header">
                <div>
                    <p class="admin-order-id">Customer</p>
                    <h2>{{ $order['customer_name'] }}</h2>
                    <p class="admin-order-meta">
                        {{ $order['item_count'] }} {{ \Illuminate\Support\Str::plural('item', $order['item_count']) }}
                    </p>
                </div>

                <div class="admin-order-card-header-side">
                    <span class="admin-order-status status-{{ strtolower($order['status']) }}">{{ $order['status'] }}</span>
                    <strong>£{{ number_format($order['total'], 2) }}</strong>
                </div>
            </div>

            <div class="admin-order-card-body">
                <div class="admin-order-details">
                    <div class="admin-order-panel">
                        <h3>Customer</h3>
                        <p>{{ $order['customer_name'] }}</p>
                        <p>{{ $order['customer_email'] ?: 'No email provided' }}</p>
                        <p>{{ $order['customer_phone'] ?: 'No phone provided' }}</p>
                    </div>

                    <div class="admin-order-panel">
                        <h3>Delivery Address</h3>
                        @if (count($order['address_lines']) > 0)
                            @foreach ($order['address_lines'] as $line)
                                <p>{{ $line }}</p>
                            @endforeach
                        @else
                            <p>No saved address for this customer.</p>
                        @endif
                    </div>

                    <div class="admin-order-panel">
                        <h3>Update Status</h3>
                        <form method="POST" action="{{ route('admin.orders.update', $order['id']) }}" class="admin-order-status-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="redirect_to" value="show">

                            <select name="OrderStatus" aria-label="Update order status for order {{ $order['id'] }}">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($order['status'] === $status)>{{ $status }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="admin-orders-primary-btn">Save</button>
                        </form>
                    </div>
                </div>

                <div class="admin-order-items">
                    <h3>Items in this order</h3>

                    @foreach ($order['items'] as $item)
                        <div class="admin-order-item">
                            <div class="admin-order-item-main">
                                <img
                                    src="{{ asset($item['image_url'] ?: 'assets/images/products/necklace1.jpg') }}"
                                    alt="{{ $item['product_name'] }}"
                                >

                                <div>
                                    <strong>{{ $item['product_name'] }}</strong>
                                    <p>Qty {{ $item['quantity'] }}</p>
                                </div>
                            </div>

                            <div class="admin-order-item-pricing">
                                <span>£{{ number_format($item['price'], 2) }} each</span>
                                <strong>£{{ number_format($item['line_total'], 2) }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>
    </div>
@endsection
