@extends("admin.layouts.app")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        <h6 class="mb-0 text-uppercase">Users Management</h6>
        <hr />

        <!-- Filter Form -->
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('userlist') }}" class="mb-4">
                        <div class="row g-3">

                            <div class="col-md-3">
                                <input type="text" name="email" class="form-control"
                                    placeholder="Search Email"
                                    value="{{ request('email') }}">
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="mobile_number" class="form-control"
                                    placeholder="Search Mobile"
                                    value="{{ request('mobile_number') }}">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button type="button" class="btn btn-primary" id="resetFilter">Reset</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        <!-- Table -->
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userlists as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name ?? 'N/A' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile_number }}</td>
                        <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                        <td><i class="fa fa-history" title="History"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ Pagination inside a footer for better design -->
    <div class="card-footer d-flex justify-content-center">
        {{ $userlists->links('pagination::bootstrap-4') }}
    </div>
</div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $('#resetFilter').click(function() {
        window.location.href = "{{ route('userlist') }}";
    });
</script>
@endsection
