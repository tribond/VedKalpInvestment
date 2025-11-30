@extends("layouts.app")
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
        <h6 class="mb-0 text-uppercase">Signal History</h6>
        <hr />

        <!-- Filter Form -->
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('trading.history') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="trade_type" class="form-control">
                                <option value="">Select Trade Type</option>
                                <option value="1" {{ request('trade_type') == '1' ? 'selected' : '' }}>Pending</option>
                                <option value="2" {{ request('trade_type') == '2' ? 'selected' : '' }}>Executed</option>
                            </select>
                        </div>
                        <div class="col-md-4">
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
                    <th>Script</th>
                    <th>Strategy</th>
                    <th>Quantity</th>
                    <th>Is Live</th>
                    <th>Executed</th>
                    <th>Trade Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tradinghistory as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user->name ?? 'N/A' }}</td>
                        <td>{{ $script_list[$log->product_id] ?? 'N/A' }}</td>
                        <td>{{ $strategy_list[$log->stratagy_id] ?? 'N/A' }}</td>
                        <td>{{ $log->quantity }}</td>
                        
                        <td>
                            @if($log->is_live == 0)
                                <button class="btn btn-danger btn-sm">No</button>
                            @elseif($log->is_live == 1)
                                <button class="btn btn-success btn-sm">Yes</button>
                            @endif
                        </td>
                        <td>
                            @if($log->tradelog->trade_type == 1)
                                <button class="btn btn-danger btn-sm">Pending</button>
                            @elseif($log->tradelog->trade_type == 2)
                                <button class="btn btn-success btn-sm">Executed</button>
                            @endif
                        </td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ Pagination inside a footer for better design -->
    <div class="card-footer d-flex justify-content-center">
        {{ $tradinghistory->links('pagination::bootstrap-4') }}
    </div>
</div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $('#resetFilter').click(function() {
        window.location.href = "{{ route('trading.history') }}";
    });
</script>
@endsection
