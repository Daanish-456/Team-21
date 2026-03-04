@extends('layouts.app')

@section('title', 'Stone & Soul - Admin Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin-dashboard.css') }}">
@endpush

@section('content')
    <div class="admin-dashboard">
        <section class="admin-stats-grid">
            @foreach ($stats as $stat)
                <article class="admin-stat-card">
                    <p>{{ $stat['label'] }}</p>
                    <strong>{{ $stat['value'] }}</strong>
                </article>
            @endforeach
        </section>

        <section class="admin-main-grid">
            <article class="admin-section-card">
                <div class="admin-section-heading">
                    <div>
                        <p class="admin-section-kicker">Orders</p>
                        <h2>Recent Orders</h2>
                    </div>
                    <a href="{{ route('shop') }}" class="admin-inline-link">View storefront</a>
                </div>

                <div class="admin-orders-table">
                    <div class="admin-orders-row admin-orders-row-head">
                        <span>Order</span>
                        <span>Customer</span>
                        <span>Item</span>
                        <span>Status</span>
                        <span>Total</span>
                    </div>

                    @foreach ($orders as $order)
                        <div class="admin-orders-row">
                            <span>#{{ $order['id'] }}</span>
                            <span>{{ $order['customer'] }}</span>
                            <span>{{ $order['item'] }}</span>
                            <span class="admin-status">{{ $order['status'] }}</span>
                            <span>{{ $order['total'] }}</span>
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="admin-section-card admin-section-card-tall">
                <div class="admin-section-heading">
                    <div>
                        <p class="admin-section-kicker">Inventory</p>
                        <h2>Low Stock Watch</h2>
                    </div>
                    <a href="{{ route('admin.stock') }}" class="admin-inline-link">Manage stock</a>
                </div>

                <div class="admin-stock-list">
                    @forelse ($inventory as $item)
                        <a href="{{ route('admin.stock.edit', $item['id']) }}" class="admin-stock-item">
                            <div>
                                <strong>{{ $item['name'] }}</strong>
                                <span>{{ $item['category'] }}</span>
                            </div>
                            <span class="admin-stock-count">{{ $item['stock'] }} left</span>
                        </a>
                    @empty
                        <div class="admin-stock-item">
                            <div>
                                <strong>No low stock products</strong>
                                <span>Everything is above the low-stock threshold.</span>
                            </div>
                            <span class="admin-stock-count">0 alerts</span>
                        </div>
                    @endforelse
                </div>
            </article>
        </section>
    </div>
@endsection
