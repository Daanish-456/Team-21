@extends('layouts.app')

@section('title', 'Stone & Soul - Contact Us')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endpush

@section('content')
    <div class="contact-container">
        <h1>Contact Us</h1>
        <div class="contact-form-content">
            <p>If you are unsatisfied with a product or have any other queries please contact us below.</p>

            @if(Session::has("success"))
                <p>{{ Session::get("success") }}</p>
            @endif

            <form class="contact-form" action="/contact" method="post">
                @csrf

                <div class="error-container">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    @error('message')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <label for="name">Full Name</label>
                <input type="text" class="contact-field" id="name" name="name" value="{{ old('name') }}">

                <label for="email">Email</label>
                <input type="email" class="contact-field" id="email" name="email" value="{{ old('email') }}">

                <label for="contact-reason">Message</label>
                <textarea name="message" class="contact-field" id="message" value="{{ old('message') }}"></textarea>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
@endsection