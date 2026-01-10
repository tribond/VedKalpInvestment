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
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <button type="submit" class="btn btn-choose w-100">Add to Cart</button>
                                </form>
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
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Cart',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Update cart count
                            let badge = document.querySelector('.cart-count');
                            let currentCount = parseInt(badge.textContent) || 0;
                            badge.textContent = currentCount + 1;
                            badge.style.display = 'inline';
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Cart Limit Reached',
                                text: data.message,
                                showConfirmButton: true
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong'
                        });
                    });
                });
            });
        });
    </script>
@endsection
