		@extends("layouts.app")
		@section("wrapper")
            <div class="page-wrapper">
                <div class="page-content">
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">User Profile</div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profilep</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <!--end breadcrumb-->
                    <div class="container">
                        <div class="main-body">
                            <div class="row">
                                <form action="{{route('update-profile')}}">
                                    @csrf
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name}}" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" name="email" class="form-control" value="{{ auth()->user()->email}}" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Mobile</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" name="mobile_no" class="form-control" value="{{ auth()->user()->mobile_no}}" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		@endsection



