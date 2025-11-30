@extends('layouts.app')

@section('title', 'Stone & Soul - Register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
    <div class="container">
        <h2>Register</h2>

        <div class="error-container">
            @if (Session::has('error'))
                <p>{{ Session::get('error') }}</p>
            @endif
        </div>

        <form method="post" action="/register">
            @csrf

            <label for="email">Email</label>
            <input type="email" name="email" class="form-field">

            <label for="name">Name</label>
            <input type="text" name="name" class="form-field">

            <label for="password">Password</label>
            <input type="password" name="password" class="form-field">

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-field">

            <a href="{{ route('register') }}">Don't have an account? Click here to register!</a>

            <button type="submit">Register</button>
        </form>
    </div>
@endsection