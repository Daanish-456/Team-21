<footer class="site-footer">
    <div class="site-footer-container">
        <div class="site-footer-grid">

          
            <div class="footer-brand-column">
                <h2 class="footer-logo">Stone &amp; Soul</h2>

                <p class="footer-description">
                    Ethical and sustainable jewellery designed with meaning.
                    Thoughtfully created for those who value beauty, craftsmanship,
                    and conscious choices.
                </p>

                <div class="footer-contact-block">
                    <p class="footer-contact-title">Need help?</p>
                    <a href="tel:+447000000000">+44 (0)7999 999999</a>
                    <a href="mailto:customercare@stoneandsoul.co.uk">
                        customercare@stoneandsoul.co.uk
                    </a>
                </div>

                <p class="footer-note">
                    Please note: online customer support is available for order queries,
                    delivery questions, and general assistance.
                </p>
            </div>

           
            <div class="footer-links-column">
                <h3>About Us</h3>
                <ul>
                    <li><a href="{{ url('/about') }}">Our Story</a></li>
                    <li><a href="{{ url('/ethical-sourcing') }}">Ethical Sourcing</a></li>
                    <li><a href="{{ url('/about') }}">Our Values</a></li>
                </ul>
            </div>

           
            <div class="footer-links-column">
                <h3>Customer Care</h3>
                <ul>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                    <li><a href="{{ url('/fast-delivery') }}">Delivery Information</a></li>
                    <li><a href="{{ url('/easy-returns') }}">Returns &amp; Exchanges</a></li>
                    <li><a href="{{ url('/faqs') }}">FAQs</a></li>
                    <li><a href="{{ url('/ring-sizing-guide') }}">Ring Sizing Guide</a></li>
                </ul>
            </div>

           
            <div class="footer-newsletter-column">
                <h3>Newsletter</h3>

                <p class="footer-newsletter-text">
                    Join our community for product updates, exclusive offers,
                    and early access to new collections.
                </p>

                <form class="footer-newsletter-form" action="{{ route('newsletter.store') }}" method="POST">
                    @csrf

                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Name" 
                        value="{{ old('name') }}" 
                        required
                    >

                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}" 
                        required
                    >

                    <button type="submit">Sign Up</button>

                    
                    @if(session('newsletter_success'))
                        <p class="newsletter-success">
                            {{ session('newsletter_success') }}
                        </p>
                    @endif

                    
                    @error('name')
                        <p class="newsletter-error">{{ $message }}</p>
                    @enderror

                    @error('email')
                        <p class="newsletter-error">{{ $message }}</p>
                    @enderror
                </form>

                <div class="footer-socials">
                    <a href="#" aria-label="Instagram">Instagram</a>
                    <a href="#" aria-label="TikTok">TikTok</a>
                    <a href="#" aria-label="Pinterest">Pinterest</a>
                </div>
            </div>

        </div>

        <div class="site-footer-bottom">
            <p>&copy; 2026 Team 21 - Stone &amp; Soul - Ethical &amp; Sustainable Jewellery</p>
        </div>
    </div>
</footer>