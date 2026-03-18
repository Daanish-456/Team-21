@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f5f1] text-[#3e2f27] py-12">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-semibold mb-4">Frequently Asked Questions</h1>
            <p class="text-lg text-[#6b5b52]">
                Helpful answers to common questions about Stone & Soul.
            </p>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-2">How long does delivery take?</h2>
                <p class="text-[#5a4a42]">Standard UK delivery usually takes 2–4 working days.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-2">Can I return my order?</h2>
                <p class="text-[#5a4a42]">Yes, returns can be requested within 30 days, subject to our returns conditions.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-2">Do I need an account to order?</h2>
                <p class="text-[#5a4a42]">Currently, an account may be required depending on checkout functionality available on the site.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-2">How can I contact Stone & Soul?</h2>
                <p class="text-[#5a4a42]">You can contact us through the contact page for any questions or support.</p>
            </div>
        </div>
    </div>
</div>
@endsection