@extends('layouts.app')

@section('title', 'Stone & Soul - Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
    <div class="container">
        <h2>Login</h2>

        <div class="error-container">
            @if (Session::has('error'))
                <p>{{ Session::get('error') }}</p>
            @endif
        </div>

        <form method="post" action="/login">
            @csrf

            <label for="email">Email</label>
            <input type="email" name="email" class="form-field">

            <label for="password">Password</label>
            <input type="password" name="password" class="form-field">

            <a href="{{ route('register') }}">Don't have an account? Click here to register!</a>

            <button type="submit">Login</button>
        </form>
    </div>
@endsection