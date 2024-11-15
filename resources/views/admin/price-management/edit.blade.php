@extends('admin.layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Price Management</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('price-managements.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @php
            $permissions = getAuthUserModulePermissions();
        @endphp
        @if (hasPermissions($permissions, 'edit-price-management'))
        <form action="" method="POST" id="priceManagementForm" name="priceManagementForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <!-- Label Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="label">Label</label>
                                <input type="text" name="label" id="label" class="form-control" value="{{ $priceManagement->label }}" placeholder="Label">
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4">{{ $priceManagement->description }}</textarea>
                            </div>
                        </div>

                        <!-- Price Type Dropdown -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="price_type">Price Type</label>
                                <select name="price_type" id="price_type" class="form-control">
                                    <option value="">Select Price Type</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Quantity->value }}" {{ $priceManagement->price_type == App\Enums\PriceTypeEnum::Quantity->value ? 'selected' : '' }}>Quantity</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Size->value }}" {{ $priceManagement->price_type == App\Enums\PriceTypeEnum::Size->value ? 'selected' : '' }}>Size</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dynamic Fields Container -->
                        <div id="dynamicFieldsContainer" class="col-md-12">
                            @if($details && $details->isNotEmpty()) 
                                @foreach ($details as $detail)
                                    <div class="row mb-3 dynamic-entry">
                                        <div class="col-md-5">
                                            <label for="order_no">Order No.</label>
                                            <input type="number" name="order_nos[]" class="form-control order-no" placeholder="Order No." value="{{ old('order_nos[]', $detail->order_no) }}">
                                            <small class="text-danger order-no-error" style="display: none;">This Order No. is already taken.</small>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="label">Label</label>
                                            <input type="text" name="labels[]" class="form-control" placeholder="Label" value="{{ old('labels[]', $detail->label) }}">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-success add-entry mr-2">+</button>
                                            <button type="button" class="btn btn-danger remove-entry">-</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default empty fields if no details exist -->
                                <div class="row mb-3 dynamic-entry">
                                    <div class="col-md-5">
                                        <label for="order_no">Order No.</label>
                                        <input type="number" name="order_nos[]" class="form-control order-no" placeholder="Order No.">
                                        <small class="text-danger order-no-error" style="display: none;">This Order No. is already taken.</small>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="label">Label</label>
                                        <input type="text" name="labels[]" class="form-control" placeholder="Label">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-success add-entry mr-2">+</button>
                                        <button type="button" class="btn btn-danger remove-entry">-</button>
                                    </div>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('price-managements.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
        @endif
    </div>
</section>
@endsection

@section('customJs')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
   <script>
  $(document).ready(function() {
    // Handle price type change
    $('#price_type').change(function() {
        $('#dynamicFieldsContainer').empty();
        addFields(); 
    });

    // Add fields function
    function addFields() {
        $('#dynamicFieldsContainer').append(`
            <div class="row mb-3 dynamic-entry">
                <div class="col-md-5">
                    <label for="order_no">Order No.</label>
                    <input type="number" name="order_nos[]" class="form-control order-no" placeholder="Order No.">
                    <small class="text-danger order-no-error" style="display: none;">This Order No. is already taken.</small>
                </div>
                <div class="col-md-5">
                    <label for="label">Label</label>
                    <input type="text" name="labels[]" class="form-control" placeholder="Label">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-success add-entry mr-2">+</button>
                    <button type="button" class="btn btn-danger remove-entry">-</button>
                </div>
            </div>
        `);
    }

    $('#dynamicFieldsContainer').on('click', '.add-entry', function() {
        let parent = $(this).closest('.dynamic-entry');
        let newEntry = parent.clone();
        newEntry.find('input').val('');
        newEntry.find('.order-no-error').hide();
        $('#dynamicFieldsContainer').append(newEntry);
    });

    $('#dynamicFieldsContainer').on('click', '.remove-entry', function() {
        $(this).closest('.dynamic-entry').remove();
    });

    $('#dynamicFieldsContainer').on('input', '.order-no', function() {
        let currentOrderNo = $(this).val();
        let hasDuplicate = false;

        $('.order-no').each(function() {
            if ($(this).val() === currentOrderNo && $(this).get(0) !== event.target) {
                hasDuplicate = true;
                return false;
            }
        });

        if (hasDuplicate) {
            $(this).siblings('.order-no-error').show();
        } else {
            $(this).siblings('.order-no-error').hide();
        }
    });

    $("#priceManagementForm").submit(function(event) {
        event.preventDefault();
        $("button[type=submit]").prop('disabled', true);

        let priceData = [];
        let hasDuplicateError = false;

        $('#dynamicFieldsContainer .dynamic-entry').each(function() {
            let order_no = $(this).find('input[name="order_nos[]"]').val();
            let label = $(this).find('input[name="labels[]"]').val();

            if ($(this).find('.order-no-error').is(':visible')) {
                hasDuplicateError = true;
            }

            if (order_no && label) {
                priceData.push({ order_no: order_no, label: label });
            }
        });

        if (hasDuplicateError) {
            $("button[type=submit]").prop('disabled', false);
            return;
        }

        $.ajax({
            url: '{{ route("price-managements.update", $priceManagement->id) }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                label: $('#label').val(),
                description: $('#description').val(),
                price_type: $('#price_type').val(),
                price_data: JSON.stringify(priceData)
            },
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status) {
                    window.location.href = "{{ route('price-managements.index') }}";
                } else {
                    // Handle validation errors
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });
    });
});

</script>
@endsection
