<footer class="footer">
    <div class="footer-container">

        <div class="footer-columns">

            <!-- Brand -->
            <div class="footer-column">
                <h3>Stone & Soul</h3>
                <p>Ethical & Sustainable Jewellery designed with meaning.</p>
            </div>

            <!-- Customer Care -->
            <div class="footer-column">
                <h4>Customer Care</h4>
                <a href="{{ route('faqs') }}">FAQs</a>
                <a href="{{ route('contact') }}">Contact Us</a>
                <a href="{{ route('easy-returns') }}">Returns & Exchanges</a>
                <a href="{{ route('fast-delivery') }}">Delivery Information</a>
            </div>

            <!-- About -->
            <div class="footer-column">
                <h4>About</h4>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('ethical-sourcing') }}">Ethical Sourcing</a>
            </div>

            <!-- Social -->
            <div class="footer-column">
                <h4>Follow Us</h4>
                <a href="#">Instagram</a>
                <a href="#">TikTok</a>
                <a href="#">Pinterest</a>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Team 21 - Stone & Soul - Ethical & Sustainable Jewellery</p>
        </div>

    </div>
</footer>