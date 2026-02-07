@extends('layouts.app')

@section('title', 'Stone & Soul - Register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
    <div class="auth-container">
        <div class="auth-form-content">
            <h1>Register</h1>

            <div class="error-container">
                @if (Session::has('error'))
                    <p class="form-error">{{ Session::get('error') }}</p>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="form-error">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <form class="auth-form" method="post" action="/register">
                @csrf

                <label for="email">Email</label>
                <input type="email" name="email" class="auth-field">

                <label for="name">Name</label>
                <input type="text" name="name" class="auth-field">

                <label for="password">Password</label>
                <input type="password" name="password" class="auth-field">

                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="auth-field">

                <button type="submit" class="submit-btn">Register</button>
            </form>

            <p class="auth-link">
                Already have an account? <a href="{{ route('login') }}">Login here!</a>
            </p>
        </div>
    </div>
@endsection
