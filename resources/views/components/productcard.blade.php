<div class="productcard">
    <img src="{{ url('website/public/' . $product->Image_URL) }}" 
         class="productcard-image" 
         alt="{{ $product->Product_Name }}" />

    <h1 class="productcard-title">
        {{ $product->Product_Name }}
    </h1>

    <p class="productcard-description">
        {{ $product->Description }}
    </p>

    <p class="productcard-price">
        £{{ $product->Price }}
    </p>
</div>