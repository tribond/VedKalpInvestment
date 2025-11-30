@extends("layouts.app")
@section("wrapper")
<?php //echo '<pre>'; print_r($trades); exit; ?>
<!-- Start page wrapper -->
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
        <h6 class="mb-0 text-uppercase">Signal Management</h6>
        <hr />
        @if(count($trades) > 0)
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('trades.update') }}" method="POST">
                        @csrf
                        <span class="trade-form">
                            @foreach($trades as $key => $trade)
                                <input type="hidden" name="data[{{$key}}][id]" value="{{ $trade->id }}">
                                    <!-- Single Trade Row -->
                                    <div class="row mb-3 trade-row">
                                        <div class="col-md-2">
                                            <select name="data[{{$key}}][product]" class="form-control is-valid" required>
                                                <option value="">Select Product</option>
                                                @foreach($product_list as $product_key => $product_val)
                                                    <option value="{{ $product_key }}" {{ ($trade->product_id == $product_key) ? 'selected' : '' }}>{{ $product_val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="data[{{$key}}][strategy]" class="form-control is-valid" required>
                                                <option value="">Select Strategy</option>
                                                @foreach($starategy_list as $strategy_key => $strategy_val)
                                                    <option value="{{ $strategy_key }}" {{ ($trade->stratagy_id == $strategy_key) ? 'selected' : '' }}>{{ $strategy_val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="data[{{$key}}][quantity]" class="form-control is-valid" placeholder="Quantity" required value="{{ $trade->quantity }}">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <!-- Hidden input for default unchecked value -->
                                                <input type="hidden" name="data[{{$key}}][live]" value="0">
                                                <input type="checkbox" name="data[{{$key}}][live]" value="1" data-trade-id="{{$trade->id}}" class="form-check-input live-toggle" id="liveToggle-{{ $key }}" {{ $trade->is_live ? 'checked' : '' }}>
                                                <label class="form-check-label" for="liveToggle-{{ $key }}">Live</label>
                                            </div>
                                        </div>
                                        @if($key == 0)
                                            <div class="col-md-2 d-flex">
                                                <button type="button" id="add-more" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-md-2 d-flex">
                                                <button type="button" class="btn btn-danger remove-row" data-id="{{ $trade->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                            @endforeach
                        </span>
                        <!-- Save Trades Button -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Save Trades</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('trades.store') }}" method="POST">
                        @csrf
                            <span class="trade-form">
                                <!-- Single Trade Row -->
                                <div class="row mb-3 trade-row">
                                    <div class="col-md-2">
                                        <select name="data[0][product]" class="form-control" required>
                                            <option value="">Select Product</option>
                                            @foreach($product_list as $key => $product)
                                                <option value="{{ $key }}">{{ $product }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="data[0][strategy]" class="form-control" required>
                                            <option value="">Select Strategy</option>
                                            @foreach($starategy_list as $key => $strategy)
                                                <option value="{{ $key }}">{{ $strategy }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="data[0][quantity]" class="form-control" placeholder="Quantity" required>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="data[0][live]" value="1" class="form-check-input" id="liveToggle">
                                            <label class="form-check-label" for="liveToggle">Live</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="button" id="add-more" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </span>
                        <!-- Save Trades Button -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Save Trades</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this trade?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End page wrapper -->
@endsection

@section("script")
<script>
$(document).ready(function () {
    // Add More Rows Dynamically
    $('#add-more').click(function () {
        let isValid = true;

        // Validate the first row fields
        $('.trade-row:first .form-control').each(function () {
            const $field = $(this);

            // Clear previous validation icons and styles
            $field.removeClass('is-invalid is-valid');
            $field.siblings('.validation-icon').remove();

            // Check if the field is empty
            if (!$field.val()) {
                isValid = false;

                // Add invalid class and red icon
                $field.addClass('is-invalid');
                $field.after('<span class="validation-icon text-danger"></span>');
            } else {
                // Add valid class and green icon
                $field.addClass('is-valid');
                $field.after('<span class="validation-icon text-success"></span>');
            }
        });

        if (!isValid) {
            return; // Prevent adding a new row if validation fails
        }
        var rowNo = $('.trade-row').length;

        // Add new row if validation passes
        let newRow = `
            <div class="row mb-3 trade-row">
                <div class="col-md-2">
                    <select name="data[${rowNo}][product]" class="form-control" required>
                        <option value="">Select Product</option>
                        @foreach($product_list as $key => $product)
                            <option value="{{ $key }}">{{ $product }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="data[${rowNo}][strategy]" class="form-control" required>
                        <option value="">Select Strategy</option>
                        @foreach($starategy_list as $key => $strategy)
                            <option value="{{ $key }}">{{ $strategy }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="data[${rowNo}][quantity]" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="col-md-2">
                    <div class="form-check form-switch">
                        <input type="hidden" name="data[${rowNo}][live]" value="0">
                        <input type="checkbox" name="data[${rowNo}][live]" value="1" class="form-check-input">
                        <label class="form-check-label">Live</label>
                    </div>
                </div>
                <div class="col-md-2 d-flex">
                    <button type="button" class="btn btn-danger remove-row mr-1">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>`;
        $('.trade-form').append(newRow);
    });

    // Remove Row
    $(document).on('click', '.remove-row', function () {
        $(this).closest('.trade-row').remove();
    });

    // Live Toggle Status Update
    $(document).on('change', '.live-toggle', function () {
        const isChecked = $(this).is(':checked') ? 1 : 0;
        const tradeIndex = $(this).attr('data-trade-id'); // Extract the key from the ID

        $.ajax({
            url: '/toggle-live',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                live: isChecked,
                index: tradeIndex
            },
            success: function (response) {
                if (response.success) {
                    alert('Live status updated!');
                } else {
                    alert('Failed to update live status.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while updating live status.');
            }
        });
    });

    // Inline Validation for Dynamic Fields
    $(document).on('change', '.form-control', function () {
        const $field = $(this);

        // Clear previous validation icons and styles
        $field.removeClass('is-invalid is-valid');
        $field.siblings('.validation-icon').remove();

        if (!$field.val()) {
            // Add invalid class and red icon
            $field.addClass('is-invalid');
            $field.after('<span class="validation-icon text-danger"></span>');
        } else {
            // Add valid class and green icon
            $field.addClass('is-valid');
            $field.after('<span class="validation-icon text-success"></span>');
        }
    });

    
});
$(document).ready(function () {
        $(document).on('click', '.remove-row', function () {
            const tradeId = $(this).data('id');
            const deleteUrl = `/trades/${tradeId}`; // Adjust the URL based on your route structure
            $('#deleteForm').attr('action', deleteUrl);
        });
    });


</script>
@endsection
