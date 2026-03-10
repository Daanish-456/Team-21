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
                    <div>
                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <select id="order_sort" name="order_sort" aria-label="Sort orders" onchange="this.form.submit()">
                                <option value="newest" {{ ($sort ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest first</option>
                                <option value="oldest" {{ ($sort ?? 'newest') === 'oldest' ? 'selected' : '' }}>Oldest first</option>
                                <option value="highest" {{ ($sort ?? 'newest') === 'highest' ? 'selected' : '' }}>Highest total</option>
                                <option value="lowest" {{ ($sort ?? 'newest') === 'lowest' ? 'selected' : '' }}>Lowest total</option>
                            </select>
                        </form>
                        <a href="{{ route('shop') }}" class="admin-inline-link">View storefront</a>
                    </div>
                </div>

                <div class="admin-orders-table">
                    <div class="admin-orders-row admin-orders-row-head">
                        <span>Order</span>
                        <span>Customer</span>
                        <span>Item</span>
                        <span>Status</span>
                        <span>Total</span>
                    </div>

                    @forelse ($orders as $order)
                        <div class="admin-orders-row">
                            <span>#{{ $order['id'] }}</span>
                            <span>{{ $order['customer'] }}</span>
                            <span>{{ $order['item'] }}</span>
                            <span class="admin-status">{{ $order['status'] }}</span>
                            <span>{{ $order['total'] }}</span>
                        </div>
                    @empty
                        <div class="admin-orders-row">
                            <span>-</span>
                            <span>No orders yet</span>
                            <span>-</span>
                            <span>-</span>
                            <span>£0.00</span>
                        </div>
                    @endforelse
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

        <section class="admin-tickets-grid">
            <article class="admin-section-card admin-section-card-wide">
                <div class="admin-section-heading">
                    <div>
                        <p class="admin-section-kicker">Support</p>
                        <h2>Contact Tickets</h2>
                    </div>
                </div>

                <div class="admin-tickets-table">
                    <div class="admin-tickets-row admin-tickets-row-head">
                        <span>Ticket</span>
                        <span>Name</span>
                        <span>Email</span>
                        <span>Message</span>
                        <span>Submitted</span>
                    </div>

                    @forelse ($tickets as $ticket)
                        <div class="admin-tickets-row">
                            <span>#{{ $ticket['id'] }}</span>
                            <span>{{ $ticket['name'] }}</span>
                            <span>{{ $ticket['email'] }}</span>
                            <span>{{ $ticket['message'] }}</span>
                            <span>{{ $ticket['submitted'] ? $ticket['submitted'] : '-' }}</span>
                        </div>
                    @empty
                        <div class="admin-tickets-row">
                            <span>-</span>
                            <span>No tickets yet</span>
                            <span>-</span>
                            <span>Customer contact tickets will appear here once submitted.</span>
                            <span>-</span>
                        </div>
                    @endforelse
                </div>
            </article>
        </section>
    </div>
@endsection
