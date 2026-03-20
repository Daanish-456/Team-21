@extends('layouts.app')

@section('title', 'Ring Sizing Guide')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/ring-sizing-guide.css') }}">
@endpush

@section('content')
<div class="ring-guide-page">

    <section class="ring-guide-hero">
        <div class="ring-guide-shell">
            <p class="ring-guide-eyebrow">Stone &amp; Soul</p>
            <h1>Ring Sizing Guide</h1>
            <p class="ring-guide-intro">
                We want to ensure you'll be happy with your ring as soon as you receive it, so it's important
                to get your ring size right the first time. Read our ring sizing guide below to easily find
                your ring size.
            </p>
        </div>
    </section>

    <section class="ring-guide-section">
        <div class="ring-guide-shell ring-guide-narrow">
            <h2>How to find your ring size</h2>
            <p class="ring-guide-subtext">
                We find the best way to find your ring size at home is to measure the internal diameter of a
                ring you already own.<br>
                Simply place a ring that already fits on top of a ruler or measuring tape to find your size.<br>
                If you come up between two sizes, for example the diameter is 18.2mm, choose the half size.
            </p>
        </div>
    </section>

    <section class="ring-guide-section">
        <div class="ring-guide-shell">
            <div class="ring-guide-card">
                <div class="ring-guide-table-wrap">
                    <table class="ring-guide-table">
                        <thead>
                            <tr>
                                <th>Internal Diameter (mm)</th>
                                <th>UK</th>
                                <th>US</th>
                                <th>EU</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>14.5</td><td>G</td><td>3.75</td><td>45</td></tr>
                            <tr><td>14.8</td><td>H</td><td>4.25</td><td>46.5</td></tr>
                            <tr><td>15.2</td><td>I</td><td>4.5</td><td>47.5</td></tr>
                            <tr><td>15.6</td><td>J</td><td>5</td><td>48.5</td></tr>
                            <tr><td>16.0</td><td>K</td><td>5.5</td><td>50</td></tr>
                            <tr><td>16.4</td><td>L</td><td>6</td><td>51</td></tr>
                            <tr><td>16.8</td><td>M</td><td>6.5</td><td>52.5</td></tr>
                            <tr><td>17.2</td><td>N</td><td>6.75</td><td>53.5</td></tr>
                            <tr><td>17.4</td><td>O</td><td>7</td><td>55</td></tr>
                            <tr><td>18.0</td><td>P</td><td>7.5</td><td>56</td></tr>
                            <tr><td>18.4</td><td>Q</td><td>8</td><td>57.5</td></tr>
                            <tr><td>19.0</td><td>R</td><td>8.5</td><td>59</td></tr>
                            <tr><td>19.2</td><td>S</td><td>9</td><td>60.25</td></tr>
                            <tr><td>19.5</td><td>T</td><td>9.5</td><td>61.25</td></tr>
                            <tr><td>20.0</td><td>U</td><td>10</td><td>63</td></tr>
                            <tr><td>20.3</td><td>V</td><td>10.5</td><td>64</td></tr>
                            <tr><td>20.7</td><td>W</td><td>11</td><td>65</td></tr>
                            <tr><td>21.1</td><td>X</td><td>11.5</td><td>66.5</td></tr>
                            <tr><td>21.4</td><td>Y</td><td>12</td><td>67.5</td></tr>
                            <tr><td>21.8</td><td>Z</td><td>12.5</td><td>69</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="ring-guide-section ring-guide-tips-section">
        <div class="ring-guide-shell">
            <h2 class="section-heading-centre">Ring Sizing Tips</h2>

            <div class="ring-guide-tips-grid">
                <article class="ring-guide-tip-card">
                    <div class="ring-guide-tip-icon">
                        &#8635;
                    </div>
                    <h3>Measure by circumference</h3>
                    <p>
                        Wrap some string or paper around your finger, and mark where it overlaps to find estimated
                        circumference.
                    </p>
                    <p>
                        Then, <a href="#">download our ring size conversion guide</a> to find your ring size.
                    </p>
                </article>

                <article class="ring-guide-tip-card">
                    <div class="ring-guide-tip-icon">
                        &#9729;
                    </div>
                    <h3>Are you hot or cold?</h3>
                    <p>
                        Your fingers can swell when you're warm, or shrink when you're cold.
                    </p>
                    <p>
                        Try to avoid measuring when you're too hot or feeling chilly - wait until you're at normal
                        body temperature.
                    </p>
                </article>

                <article class="ring-guide-tip-card">
                    <div class="ring-guide-tip-icon">
                        &#8990;
                    </div>
                    <h3>Consider ring thickness</h3>
                    <p>
                        Chunkier and wider ring styles may fit tighter than daintier designs.
                    </p>
                    <p>
                        If you're choosing a chunky ring, we recommend choosing half a size up from your normal size
                        for comfort.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="ring-guide-resize-section">
        <div class="ring-guide-resize-grid">
            <div class="ring-guide-resize-image">
                <img src="{{ asset('assets/images/products/rings/ring-resizing.jpg') }}" alt="Ring resizing">
            </div>

            <div class="ring-guide-resize-content">
                <div class="ring-guide-resize-inner">
                    <span class="ring-guide-resize-label">Need a different size?</span>
                    <h2>Ring Re-sizing</h2>
                    <p>
                        To be as environmentally-friendly as possible, we make everything to order meaning we don't
                        have spare rings to exchange, however we can resize your ring if you need a different size.
                    </p>
                    <p>
                        Please note, we may charge a small fee to cover the time and materials it takes to resize your
                        ring. If you need a resize, get in touch.
                    </p>
                    <a href="{{ route('contact') }}" class="ring-guide-btn">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <section class="ring-guide-section ring-guide-faq-section">
        <div class="ring-guide-shell ring-guide-narrow">
            <h2>Ring sizing FAQs</h2>

            <div class="ring-guide-faq-list">
                <div class="ring-guide-faq-item">
                    <button class="ring-guide-faq-question" type="button">
                        <span>Can you re-size a ring I didn't purchase from Stone &amp; Soul?</span>
                        <span>&#8964;</span>
                    </button>
                    <div class="ring-guide-faq-answer">
                        <p>
                            In most cases we only resize rings purchased from Stone &amp; Soul, but contact us and we
                            can let you know whether we may be able to help.
                        </p>
                    </div>
                </div>

                <div class="ring-guide-faq-item">
                    <button class="ring-guide-faq-question" type="button">
                        <span>How much does it cost to re-size a ring?</span>
                        <span>&#8964;</span>
                    </button>
                    <div class="ring-guide-faq-answer">
                        <p>
                            Resize costs can vary depending on the design and material. Please contact us with your
                            order details and we will advise you.
                        </p>
                    </div>
                </div>

                <div class="ring-guide-faq-item">
                    <button class="ring-guide-faq-question" type="button">
                        <span>I still need some help!</span>
                        <span>&#8964;</span>
                    </button>
                    <div class="ring-guide-faq-answer">
                        <p>
                            No problem. Visit our contact page and our team will be happy to help you choose the best
                            size before placing your order.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const faqItems = document.querySelectorAll('.ring-guide-faq-item');

        faqItems.forEach(item => {
            const button = item.querySelector('.ring-guide-faq-question');

            button.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    });
</script>
@endsection