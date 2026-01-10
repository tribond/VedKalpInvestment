@extends('layouts.default')
@section('content')
    <section id="pricing" class="pricing section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Services</h2>
            <p>Check our Services</p>
        </div>
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-center">
                @foreach ($services as $service)
                    <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <article class="price-card h-100">
                            <div class="card-head">
                                <span class="badge-title">{{ $service->subscription_type }}</span>
                                <h3 class="title">{{ $service->title }}</h3>
                                <div class="price-wrap">
                                    <span class="price price-monthly">
                                        <sup>₹</sup>{{ $service->subscription_amount }}
                                        @if ($service->subscription_duration == 'monthly')
                                            <span class="period">/mo</span>
                                        @elseif($service->subscription_duration == 'yearly')
                                            <span class="period">/yr</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            {!! $service->description !!}
                            <div class="cta">
                                <a href="#" class="btn btn-choose w-100 subscribe-btn" data-title="{{ $service->title . '(' . $service->subscription_type . ')' }}" data-amount="{{ $service->subscription_amount }}" data-duration="{{ ucfirst($service->subscription_duration) }}">Subscribe Now</a>
                                <small class="text-warning d-block mt-2">
                                    Payments are processed via <strong>Paytm AutoPay</strong>.<br />
                                    Gateway activation is pending approval.
                                </small>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@stop
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.subscribe-btn').forEach(button => {
                button.addEventListener('click', function() {

                    let title = this.dataset.title;
                    let amount = this.dataset.amount;
                    let duration = this.dataset.duration;

                    Swal.fire({
                        title: 'Confirm Subscription',
                        html: `
                            <h6 class="text-bg-warning p-3">Payment gateway integration in progress. AutoPay will be enabled after verification.</h6>
                            <p><strong>Service:</strong> ${title}</p>
                            <p><strong>Plan:</strong> ${duration}</p>
                            <p class="mt-2">
                                <strong>Final Amount:</strong>
                                <span style="font-size:18px;">₹${amount}</span>
                            </p>
                            <button id="paytmPayBtn" class="btn btn-primary w-100 mt-3">
                                Pay with 
                                <img src="{{ asset('assets/img/paytm-logo.png') }}" alt="Paytm" style="height:24px;background:#fff;padding:3px;border-radius:4px;">
                            </button>
                        `,
                        showConfirmButton: false,
                        showCloseButton: true
                    });

                    // Handle Paytm button click
                    document.addEventListener('click', function handler(e) {
                        if (e.target && e.target.id === 'paytmPayBtn') {
                            document.removeEventListener('click', handler);

                            Swal.fire({
                                title: 'Redirecting to Paytm',
                                html: 'Please wait while we process your payment...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Simulate payment success (for Paytm approval phase)
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Payment Successful',
                                    text: 'Your subscription has been activated successfully.',
                                    confirmButtonText: 'OK'
                                });
                            }, 2000);
                        }
                    });

                });
            });

        });
    </script>
@endsection
