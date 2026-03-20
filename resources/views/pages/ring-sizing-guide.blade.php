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
                Finding your perfect fit matters. Use our simple guide below to measure your ring size
                from home and shop with confidence.
            </p>
        </div>
    </section>

    <section class="ring-guide-section">
        <div class="ring-guide-shell ring-guide-narrow">
            <h2>How to find your ring size</h2>
            <p>
                The easiest way to estimate your size at home is to measure the internal diameter of a
                ring that already fits comfortably. Place the ring over a ruler and measure straight
                across the centre in millimetres.
            </p>
            <p>
                If your measurement falls between sizes, it is usually best to choose the next size up
                for a more comfortable fit.
            </p>
        </div>
    </section>

    <section class="ring-guide-section">
        <div class="ring-guide-shell">
            <div class="ring-guide-card">
                <h2>Ring size conversion chart</h2>
                <p class="ring-guide-subtext">
                    Match your internal diameter measurement to the closest ring size below.
                </p>

                <div class="ring-guide-table-wrap">
                    <table class="ring-guide-table">
                        <thead>
                            <tr>
                                <th>Diameter (mm)</th>
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

    <section class="ring-guide-section">
        <div class="ring-guide-shell">
            <h2 class="section-heading-centre">Ring sizing tips</h2>

            <div class="ring-guide-tips-grid">
                <article class="ring-guide-tip-card">
                    <h3>Measure by circumference</h3>
                    <p>
                        Wrap a thin strip of paper or string around your finger, mark where it overlaps,
                        then measure the length in millimetres and compare it to a size chart.
                    </p>
                </article>

                <article class="ring-guide-tip-card">
                    <h3>Avoid hot or cold hands</h3>
                    <p>
                        Fingers naturally expand in the heat and can shrink in the cold, so measure when
                        your hands are at a normal temperature.
                    </p>
                </article>

                <article class="ring-guide-tip-card">
                    <h3>Consider ring thickness</h3>
                    <p>
                        Wider or chunkier rings often feel tighter than delicate bands, so sizing up
                        slightly can sometimes give a better fit.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="ring-guide-section">
        <div class="ring-guide-shell ring-guide-narrow">
            <div class="ring-guide-help-box">
                <h2>Need a different size?</h2>
                <p>
                    If you are unsure about sizing or need help after ordering, our customer care team
                    can guide you to the best fit.
                </p>
                <a href="{{ url('/contact') }}" class="ring-guide-btn">Contact Us</a>
            </div>
        </div>
    </section>

    <section class="ring-guide-section ring-guide-faq-section">
        <div class="ring-guide-shell ring-guide-narrow">
            <h2>Ring sizing FAQs</h2>

            <div class="ring-guide-faq-list">
                <div class="ring-guide-faq-item">
                    <h3>What if I am between two sizes?</h3>
                    <p>
                        We recommend choosing the larger size for a more comfortable fit, especially for
                        thicker ring styles.
                    </p>
                </div>

                <div class="ring-guide-faq-item">
                    <h3>Can I measure my size at home?</h3>
                    <p>
                        Yes. Measuring a ring you already own or using string/paper around your finger
                        are both simple ways to estimate your size from home.
                    </p>
                </div>

                <div class="ring-guide-faq-item">
                    <h3>Still unsure?</h3>
                    <p>
                        Visit our contact page and our team will be happy to help you choose the most
                        suitable size before you order.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection