@extends('layouts.app')

@section('title', 'Stone & Soul - Stock Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin-stock.css') }}">
@endpush

@section('content')
    <div class="admin-stock-page">
        <section class="admin-stock-hero">
            <div>
                <h1>Stock Management</h1>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="admin-stock-link">Back to dashboard</a>
        </section>

        @if (session('success'))
            <div class="admin-stock-alert admin-stock-alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="admin-stock-alert admin-stock-alert-error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="admin-stock-alert admin-stock-alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="admin-stock-layout">
            <article class="admin-stock-panel admin-stock-add-panel">
                <div class="admin-stock-panel-heading">
                    <p class="admin-stock-title">Catalogue</p>
                    <h2>Add Product</h2>
                </div>

                <form action="{{ route('admin.stock.store') }}" method="POST" class="admin-stock-form">
                    @csrf

                    <label>
                        Product name
                        <input type="text" name="Product_Name" value="{{ old('Product_Name') }}" required>
                    </label>

                    <label>
                        Category
                        <select name="CategoryID" required>
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->CategoryID }}" @selected(old('CategoryID') == $category->CategoryID)>
                                    {{ $category->CategoryName }}
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <div class="admin-stock-form-split">
                        <label>
                            Price
                            <input type="number" name="Price" step="0.01" min="0" value="{{ old('Price') }}" required>
                        </label>

                        <label>
                            Stock
                            <input type="number" name="Stock" min="0" value="{{ old('Stock') }}" required>
                        </label>
                    </div>

                    <label>
                        Image path
                        <input type="text" name="Image_URL" value="{{ old('Image_URL') }}"
                            placeholder="assets/images/products/...">
                    </label>

                    <label>
                        Description
                        <textarea name="Description" rows="5">{{ old('Description') }}</textarea>
                    </label>

                    <button type="submit" class="admin-stock-primary-btn">Add product</button>
                </form>
            </article>

            <article class="admin-stock-panel admin-stock-products-panel">
                <div class="admin-stock-panel-heading">
                    <p class="admin-stock-title">Inventory</p>
                    <h2>Browse Existing Products</h2>
                </div>

                <div class="admin-stock-product-list">
                    @foreach ($products as $product)
                        <div class="admin-stock-product-card">
                            <div class="admin-stock-card-top">
                                <div>
                                    <p class="admin-stock-product-id">Product #{{ $product->ProductID }}</p>
                                    <div class="admin-stock-product-name">{{ $product->Product_Name }}</div>
                                </div>

                                <div class="admin-stock-card-actions">
                                    <span class="admin-stock-pill {{ $product->Stock <= 5 ? 'is-low' : '' }}">
                                        {{ $product->Stock <= 5 ? 'Low stock' : 'In stock' }}
                                    </span>
                                </div>
                            </div>

                            <div class="admin-stock-card-footer">
                                <div class="admin-stock-product-meta">
                                    <span>{{ $product->category?->CategoryName ?? 'Uncategorised' }}</span>
                                    <span>£{{ number_format((float) $product->Price, 2) }}</span>
                                    <span>{{ $product->Stock }} units</span>
                                </div>

                                <a href="{{ route('admin.stock.edit', $product) }}"
                                    class="admin-stock-primary-btn admin-stock-card-link">
                                    Edit product
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        </section>
    </div>
@endsection