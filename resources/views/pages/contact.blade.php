@extends('layouts.app')

@section('title', 'Stone & Soul - Contact Us')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endpush

@section('content')
    <div class="contact-container">
        <div class="contact-form-content">
            <h1>Contact Us</h1>
            <p>If you are unsatisfied with a product or have any other queries please contact us below.</p>

            @if(Session::has("success"))
                <p class="form-success">{{ Session::get("success") }}</p>
            @endif

            <form class="contact-form" action="/contact" method="post" id="contactForm">
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

                <label for="message">Message</label>
                <textarea name="message" class="contact-field" id="message" rows="5">{{ old('message') }}</textarea>

                <div class="message-meta">
                    <small id="messageCounter">0 / 500</small>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/contact.js') }}"></script>
@endpush