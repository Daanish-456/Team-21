@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f5f1] text-[#3e2f27] py-12">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-semibold mb-4">Fast Delivery</h1>
            <p class="text-lg text-[#6b5b52]">
                We aim to get your order to you quickly, safely, and securely.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">Processing Time</h2>
                <p class="text-[#5a4a42] leading-7">
                    Orders are usually processed within 24 hours, excluding weekends and bank holidays.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">Standard Delivery</h2>
                <p class="text-[#5a4a42] leading-7">
                    Standard UK delivery usually arrives within 2–4 working days.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">Express Delivery</h2>
                <p class="text-[#5a4a42] leading-7">
                    Express delivery options are available at checkout for faster delivery.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">Tracking Your Order</h2>
                <p class="text-[#5a4a42] leading-7">
                    Once your order has been dispatched, you will receive confirmation and any available tracking details.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection