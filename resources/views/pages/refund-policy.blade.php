@extends('layouts.default')
@section('content')
    <div class="container">
        <h1>Refund Policy</h1>
        <p><strong>Last updated:</strong> 01 January 2026</p>

        <p>
            This Refund Policy applies to all purchases made through {{ config('constants.SITE_NAME') }}.
        </p>

        <h2>1. Refund Eligibility</h2>
        <p>Refunds may be considered under the following circumstances:</p>
        <ul>
            <li>Duplicate payment</li>
            <li>Payment error or technical issue</li>
            <li>Service not delivered as described</li>
        </ul>

        <h2>2. Non-Refundable Cases</h2>
        <ul>
            <li>Services already delivered</li>
            <li>Change of mind after service commencement</li>
            <li>Incorrect information provided by the user</li>
        </ul>

        <h2>3. Refund Request Process</h2>
        <p>
            To request a refund, please email us with the following details:
        </p>
        <ul>
            <li>Full name</li>
            <li>Registered email address</li>
            <li>Transaction ID</li>
            <li>Reason for refund</li>
        </ul>

        <p>
            Email:
            <a href="mailto:{{ config('constants.ADMIN_EMAIL') }}">
                {{ config('constants.ADMIN_EMAIL') }}
            </a>
        </p>

        <h2>4. Processing Time</h2>
        <p>
            Approved refunds will be processed within 7–10 business days
            to the original payment method.
        </p>
    </div>
@stop
@section('script')
@endsection
