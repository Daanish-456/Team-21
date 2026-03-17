@extends('layouts.app')

@section('title', 'Stone & Soul - Account')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/account.css') }}" />
@endpush

@section('content')
    <div class="account-container">
        <div class="account-layout">
            <section class="account-card account-section">
                <div class="card-heading">
                    <p class="card-kicker">Profile</p>
                    <h2>Account Details</h2>
                </div>

                @if(session('profile_success'))
                    <div class="form-alert form-alert-success">{{ session('profile_success') }}</div>
                @endif

                @if($errors->profile->any())
                    <div class="form-alert form-alert-error">Please fix the highlighted details and try again.</div>
                @endif

                <form action="{{ route('account.details.update') }}" method="POST"
                    class="account-form account-form-profile">
                    @csrf

                    <label class="form-field" for="account-name">
                        <span class="detail-label">Name</span>
                        <input id="account-name" type="text" name="name" value="{{ old('name', $user->Name) }}" required />
                        @error('name', 'profile')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field" for="account-email">
                        <span class="detail-label">Email</span>
                        <input id="account-email" type="email" name="email" value="{{ old('email', $user->Email) }}"
                            required />
                        @error('email', 'profile')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field" for="account-phone">
                        <span class="detail-label">Phone</span>
                        <input id="account-phone" type="text" name="phone" value="{{ old('phone', $user->Phone) }}"
                            placeholder="Add a phone number" />
                        @error('phone', 'profile')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="form-actions form-actions-split">
                        <a href="{{ route('logout') }}" class="account-btn account-btn-danger">Logout</a>
                        <button type="submit" class="account-btn account-btn-primary">Save Details</button>
                    </div>
                </form>
            </section>

            <section class="account-card account-section">
                <div class="card-heading">
                    <h2>Address</h2>
                </div>

                @if(session('address_success'))
                    <div class="form-alert form-alert-success">{{ session('address_success') }}</div>
                @endif

                @if($errors->address->any())
                    <div class="form-alert form-alert-error">Please fix the highlighted address fields and try again.</div>
                @endif

                <form action="{{ route('account.address.update') }}" method="POST"
                    class="account-form account-form-address">
                    @csrf

                    <label class="form-field form-field-wide" for="address-line-1">
                        <span class="detail-label">Address Line 1</span>
                        <input id="address-line-1" type="text" name="address_line_1"
                            value="{{ old('address_line_1', $addressFields['address_line_1']) }}" required />
                        @error('address_line_1', 'address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field form-field-wide" for="address-line-2">
                        <span class="detail-label">Address Line 2</span>
                        <input id="address-line-2" type="text" name="address_line_2"
                            value="{{ old('address_line_2', $addressFields['address_line_2']) }}" />
                        @error('address_line_2', 'address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field" for="address-city">
                        <span class="detail-label">Town / City</span>
                        <input id="address-city" type="text" name="city" value="{{ old('city', $addressFields['city']) }}"
                            required />
                        @error('city', 'address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field" for="address-county">
                        <span class="detail-label">County / State</span>
                        <input id="address-county" type="text" name="county"
                            value="{{ old('county', $addressFields['county']) }}" />
                        @error('county', 'address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field" for="address-postcode">
                        <span class="detail-label">Postcode</span>
                        <input id="address-postcode" type="text" name="postcode"
                            value="{{ old('postcode', $addressFields['postcode']) }}" required />
                        @error('postcode', 'address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-field" for="address-country">
                        <span class="detail-label">Country</span>
                        <input id="address-country" type="text" name="country"
                            value="{{ old('country', $addressFields['country']) }}" required />
                        @error('country', 'address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="form-actions">
                        <button type="submit" class="account-btn account-btn-secondary">Save Address</button>
                    </div>
                </form>
            </section>

            <section class="account-card account-main account-section">
                <div class="orders-heading">
                    <div>
                        <p class="card-kicker">Purchase History</p>
                        <h2>Recent Orders</h2>
                    </div>
                    <a href="{{ route('shop') }}" class="account-btn account-btn-secondary orders-action">Continue
                        Shopping</a>
                </div>

                <div class="orders-list">
                    @if(isset($orders) && count($orders) > 0)
                        @foreach($orders as $order)
                            <div class="order-card" data-order-id="{{ $order->OrderID }}">
                                <div class="order-header">
                                    <div>
                                        <span class="order-number">Order #{{ $order->OrderID }}</span>
                                        <span class="order-date">Placed on {{ date('d M Y', strtotime($order->OrderDate)) }}</span>
                                    </div>
                                    <div class="order-header-meta">
                                        <span class="order-total-inline">£{{ number_format($order->TotalAmount, 2) }}</span>
                                        <span
                                            class="order-status {{ strtolower($order->OrderStatus) }}">{{ $order->OrderStatus }}</span>
                                    </div>
                                </div>
                                <div class="order-items">
                                    @if(isset($order->items) && count($order->items) > 0)
                                        @foreach($order->items as $item)
                                            <div class="order-item">
                                                <img src="{{ asset($item->product->Image_URL ?? 'assets/images/example-necklace.png') }}"
                                                    alt="Product" />
                                                <div class="order-item-copy">
                                                    <p class="item-name">{{ $item->product->Product_Name ?? 'Product' }}</p>
                                                    <p class="item-price">£{{ number_format($item->Price, 2) }}</p>
                                                </div>
                                                <span class="item-qty">Amount {{ $item->Quantity }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="order-total">Total: £{{ number_format($order->TotalAmount, 2) }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <p class="empty-title">No orders yet</p>
                            <p class="empty-copy">Once you place an order, it will appear here with item details and totals.</p>
                            <a href="{{ route('shop') }}" class="account-btn account-btn-primary">Browse Jewellery</a>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection