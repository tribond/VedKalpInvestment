@extends('layouts.default')

@section('content')
    <div class="container">
        <h4 class="mb-4">
            <i class="bi bi-receipt"></i> Payment History
        </h4>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                @if ($payments->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Paid At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $key => $payment)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $payment->transaction_id }}</td>
                                        <td>
                                            ₹{{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td>
                                            {{ ucfirst($payment->payment_method ?? 'N/A') }}
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match ($payment->payment_status) {
                                                    'success' => 'success',
                                                    'failed' => 'danger',
                                                    'pending' => 'warning',
                                                    'refunded' => 'secondary',
                                                    default => 'dark',
                                                };
                                            @endphp

                                            <span class="badge bg-{{ $statusClass }}">
                                                {{ ucfirst($payment->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $payment->paid_at ? $payment->paid_at->format('d M Y, h:i A') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1"></i>
                        <p class="mt-3">No payment history found.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@stop
@section('script')
@endsection
