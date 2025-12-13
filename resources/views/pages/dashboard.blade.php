@extends('layouts.default')
@section('content')
    <section id="pricing" class="pricing section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Services</h2>
            <p>Check our Services</p>
        </div>
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <article class="price-card h-100">
                        <div class="card-head">
                            <span class="badge-title">Starter</span>
                            <h3 class="title">Lorem Dolor Sit</h3>
                            <p class="subtitle">Ut enim ad minim veniam quis nostrud exercitation ullamco laboris.</p>
                            <div class="price-wrap">
                                <span class="price price-monthly"><sup>$</sup>12<span class="period">/mo</span></span>
                                <span class="price price-yearly"><sup>$</sup>120<span class="period">/yr</span></span>
                            </div>
                        </div>

                        <ul class="feature-list list-unstyled mb-4">
                            <li><i class="bi bi-check-circle"></i> Lorem ipsum dolor amet</li>
                            <li><i class="bi bi-check-circle"></i> Consectetur adipiscing elit</li>
                            <li><i class="bi bi-check-circle"></i> Sed do eiusmod tempor</li>
                            <li class="muted"><i class="bi bi-dash-circle"></i> Incididunt ut labore</li>
                            <li class="muted"><i class="bi bi-dash-circle"></i> Dolore magna aliqua</li>
                        </ul>

                        <div class="cta">
                            <a href="#" class="btn btn-choose w-100">Get Started</a>
                        </div>
                    </article><!-- End Pricing Item -->
                </div>
            </div>
        </div>

    </section>
@stop
@section('script')
@endsection
