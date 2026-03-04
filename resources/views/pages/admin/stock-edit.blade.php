@extends('layouts.app')

@section('title', 'Stone & Soul - Edit Product')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin-stock.css') }}">
@endpush

@section('content')
    <div class="admin-stock-page">
        <section class="admin-stock-hero">
            <div>
                <p class="admin-stock-eyebrow">Stock Management</p>
                <h1>Edit Product</h1>
            </div>

            <a href="{{ route('admin.stock') }}" class="admin-stock-link">Back to stock management</a>
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

        <section class="admin-stock-edit-layout">
            <article class="admin-stock-panel admin-stock-edit-main">
                <div class="admin-stock-panel-heading">
                    <div>
                        <p class="admin-stock-kicker">Product #{{ $product->ProductID }}</p>
                        <h2>{{ $product->Product_Name }}</h2>
                    </div>
                    <span class="admin-stock-pill {{ $product->Stock <= 5 ? 'is-low' : '' }}">
                        {{ $product->Stock <= 5 ? 'Low stock' : 'In stock' }}
                    </span>
                </div>

                <form action="{{ route('admin.stock.update', $product) }}" method="POST" class="admin-stock-edit-form">
                    @csrf
                    @method('PUT')

                    <label>
                        Product name
                        <input type="text" name="Product_Name" value="{{ old('Product_Name', $product->Product_Name) }}"
                            required>
                    </label>

                    <div class="admin-stock-form-grid">
                        <label>
                            Category
                            <select name="CategoryID" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->CategoryID }}" @selected((int) old('CategoryID', $product->CategoryID) === (int) $category->CategoryID)>
                                        {{ $category->CategoryName }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <label>
                            Price
                            <input type="number" name="Price" step="0.01" min="0"
                                value="{{ old('Price', $product->Price) }}" required>
                        </label>

                        <label>
                            Stock
                            <input type="number" name="Stock" min="0" value="{{ old('Stock', $product->Stock) }}" required>
                        </label>
                    </div>

                    <label>
                        Image path
                        <input type="text" name="Image_URL" value="{{ old('Image_URL', $product->Image_URL) }}">
                    </label>

                    <label>
                        Description
                        <textarea name="Description" rows="6">{{ old('Description', $product->Description) }}</textarea>
                    </label>

                    <button type="submit" class="admin-stock-primary-btn">Save changes</button>
                </form>
            </article>

            <aside class="admin-stock-panel admin-stock-side-panel">
                <div class="admin-stock-panel-heading">
                    <div>
                        <p class="admin-stock-kicker">Quick Info</p>
                        <h2>Product Summary</h2>
                    </div>
                </div>

                <div class="admin-stock-summary">
                    <div>
                        <span>Category</span>
                        <strong>{{ $product->category?->CategoryName ?? 'Uncategorised' }}</strong>
                    </div>
                    <div>
                        <span>Price</span>
                        <strong>£{{ number_format((float) $product->Price, 2) }}</strong>
                    </div>
                    <div>
                        <span>Stock</span>
                        <strong>{{ $product->Stock }} units</strong>
                    </div>
                </div>

                <div class="admin-stock-card-footer">
                    <form action="{{ route('admin.stock.destroy', $product) }}" method="POST"
                        onsubmit="return confirm('Delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-stock-danger-btn">Delete product</button>
                    </form>
                </div>
            </aside>
        </section>
    </div>
@endsection