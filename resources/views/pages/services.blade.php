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
                    <div class="col-lg-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
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
                            {!! $service->short_description !!}
                            <button class="bg-dark-subtle btn fw-bold mb-4 read-more" data-bs-toggle="modal" data-bs-target="#modal_service_{{ $service->id }}">Read More</button>
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

    @foreach ($services as $service)
        <div class="modal fade" id="modal_service_{{ $service->id }}" tabindex="-1" aria-labelledby="modal_service_{{ $service->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_service_{{ $service->id }}Label">{{ $service->subscription_type . ' - ' . $service->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!! $service->description !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
