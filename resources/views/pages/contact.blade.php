@extends('layouts.default')
@section('content')

 

@stop

@section('script')
    <script src="{{ asset('assets/js/particles/particles.min.js') }}"></script>
    <script>
        var contactUsLeadUrl = "{{ route('contactUsLead') }}";
    </script>
    <script src="{{ asset('assets/js/form-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/contact-us/contact-us.js') }}"></script>
@endsection
