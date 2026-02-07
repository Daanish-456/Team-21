@extends('layouts.app')

@section('title', 'Stone & Soul - Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
    <div class="auth-container">
        <div class="auth-form-content">
            <h1>Login</h1>

            <div class="error-container">
                @if (Session::has('error'))
                    <p class="form-error">{{ Session::get('error') }}</p>
                @endif
            </div>

            <form class="auth-form" method="post" action="/login">
                @csrf

                <label for="email">Email</label>
                <input type="email" name="email" class="auth-field">

                <label for="password">Password</label>
                <input type="password" name="password" class="auth-field">

                <button type="submit" class="submit-btn">Login</button>
            </form>

            <p class="auth-link">
                Don't have an account? <a href="{{ route('register') }}">Register here!</a>
            </p>
        </div>
    </div>
@endsection
