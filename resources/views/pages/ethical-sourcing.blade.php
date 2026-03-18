@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8f5f1] text-[#3e2f27] py-12">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-semibold mb-4">Our Commitment to Ethical Sourcing</h1>
            <p class="text-lg text-[#6b5b52] max-w-3xl mx-auto">
                At Stone & Soul, we believe jewellery should be beautiful, meaningful, and responsibly made.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-4">Responsible Materials</h2>
                <p class="text-[#5a4a42] leading-7">
                    We carefully select materials that reflect our values of quality, responsibility, and longevity.
                    Wherever possible, we prioritise recycled metals, responsibly sourced stones, and low-impact
                    production methods.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-4">Fair Production</h2>
                <p class="text-[#5a4a42] leading-7">
                    We aim to work with suppliers who value fair working conditions, skilled craftsmanship,
                    and safe environments. We believe every piece should be made with care and respect.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-4">Sustainability Matters</h2>
                <p class="text-[#5a4a42] leading-7">
                    We are committed to reducing our environmental impact through mindful design choices,
                    recyclable packaging, and more conscious production practices as our brand grows.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-4">Transparency</h2>
                <p class="text-[#5a4a42] leading-7">
                    We know ethical sourcing is an ongoing journey. We are committed to learning, improving,
                    and being transparent with our customers about the values behind our collections.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection