@extends('layouts.app')

@section('title', 'Stone & Soul - Manage Orders')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin-orders.css') }}">
@endpush

@section('content')
    <div class="admin-orders-page">
        <section class="admin-orders-hero">
            <div>
                <h1>Manage Orders</h1>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="admin-orders-link">Back to dashboard</a>
        </section>

        @if (session('success'))
            <div class="admin-orders-alert admin-orders-alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="admin-orders-alert admin-orders-alert-error">{{ $errors->first() }}</div>
        @endif

        <section class="admin-orders-summary">
            <article class="admin-orders-stat">
                <span>Total orders</span>
                <strong>{{ $totalOrders }}</strong>
            </article>

            @foreach ($statuses as $status)
                <article class="admin-orders-stat">
                    <span>{{ $status }}</span>
                    <strong>{{ $statusCounts[$status] ?? 0 }}</strong>
                </article>
            @endforeach
        </section>

        <section class="admin-order-filters-container">
            <form method="GET" action="{{ route('admin.orders') }}" class="admin-orders-filters">
                <label>
                    Status
                    <select name="status">
                        <option value="">All statuses</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </label>

                <label for="sort">
                    Sort
                    <select name="sort">
                        <option value="newest" @selected($selectedSort === 'newest')>Newest first</option>
                        <option value="oldest" @selected($selectedSort === 'oldest')>Oldest first</option>
                        <option value="highest" @selected($selectedSort === 'highest')>Highest total</option>
                        <option value="lowest" @selected($selectedSort === 'lowest')>Lowest total</option>
                    </select>
                </label>

                <button type="submit" class="admin-orders-primary-btn">Apply</button>
            </form>
        </section>

        <section class="admin-orders-list">
            @foreach ($orders as $order)
                <article class="admin-order-card">
                    <div class="admin-order-card-header">
                        <div>
                            <p class="admin-order-id">Order #{{ $order['id'] }}</p>
                            <h2>{{ $order['customer_name'] }}</h2>
                            <p class="admin-order-meta">
                                {{ $order['placed_at']->format('d M Y, H:i') }} · {{ $order['item_count'] }}
                                {{ \Illuminate\Support\Str::plural('item', $order['item_count']) }}
                            </p>
                        </div>

                        <div class="admin-order-card-header-side">
                            <span class="admin-order-status status-{{ strtolower($order['status']) }}">{{ $order['status'] }}</span>
                            <strong>£{{ number_format($order['total'], 2) }}</strong>
                        </div>
                    </div>

                    <div class="admin-order-list-body">
                        <div class="admin-order-list-meta">
                            <p>{{ $order['customer_email'] ?: 'No email provided' }}</p>
                            <p>{{ $order['customer_phone'] ?: 'No phone provided' }}</p>
                        </div>

                        <a href="{{ route('admin.orders.show', $order['id']) }}" class="admin-orders-primary-btn">
                            View order details
                        </a>
                    </div>
                </article>
            @endforeach
        </section>
    </div>
@endsection
