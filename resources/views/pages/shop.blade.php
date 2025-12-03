@extends('layouts.app')

@section('title', 'Stone & Soul - Browse')

@section('content')
    <div>
        {{-- test --}}
        @foreach ($products as $product)
            <p>{{ $product->Product_Name . $product->Price}}</p>
        @endforeach
    </div>
@endsection