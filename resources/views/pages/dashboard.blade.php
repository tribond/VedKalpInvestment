@extends("layouts.app")
@section("style")
    <link href="{{asset('plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Products</p>
                                    <h4 class="my-1 text-info">00</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

        </div>
    </div>
@endsection

@section("script")
    <script src="{{asset('plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('plugins/chartjs/js/Chart.min.js')}}"></script>
    <script src="{{asset('plugins/chartjs/js/Chart.extension.js')}}"></script>
    <script src="{{asset('plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('js/admin/index.js')}}"></script>
@endsection
