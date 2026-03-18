@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f5f1] text-[#3e2f27] py-12">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-semibold mb-4">Easy Returns & Exchanges</h1>
            <p class="text-lg text-[#6b5b52]">
                We want you to shop with confidence and peace of mind.
            </p>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">30-Day Returns</h2>
                <p class="text-[#5a4a42] leading-7">
                    You can request a return within 30 days of receiving your order.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">Return Conditions</h2>
                <ul class="list-disc pl-6 text-[#5a4a42] space-y-2">
                    <li>Items must be unworn and in their original condition</li>
                    <li>Original packaging should be included</li>
                    <li>Proof of purchase is required</li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">How to Return</h2>
                <ol class="list-decimal pl-6 text-[#5a4a42] space-y-2">
                    <li>Contact our support team with your order details</li>
                    <li>Follow the return instructions provided</li>
                    <li>Send the item back using the return information</li>
                </ol>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-3">Refunds & Exchanges</h2>
                <p class="text-[#5a4a42] leading-7">
                    Once your return has been received and checked, refunds are processed back to your original
                    payment method. If you would prefer an exchange, our team will be happy to help.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection