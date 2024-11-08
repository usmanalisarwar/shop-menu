@extends('admin.layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Price Management</h1>
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
        @if (hasPermissions($permissions, 'add-new-price-management'))
        <form action="" method="POST" id="priceManagementForm" name="priceManagementForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <!-- Label Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="label">Label</label>
                                <input type="text" name="label" id="label" class="form-control" placeholder="Label">
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4"></textarea>
                            </div>
                        </div>

                        <!-- Price Type Dropdown -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="price_type">Price Type</label>
                                <select name="price_type" id="price_type" class="form-control">
                                    <option value="">Select Price Type</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Quantity->value }}">Quantity</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Size->value }}">Size</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dynamic Fields Container -->
                        <div id="dynamicFieldsContainer" class="col-md-12">
                            <!-- Dynamic fields will be appended here -->
                        </div>

                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
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
                $('#dynamicFieldsContainer').empty(); // Clear previous fields
                addFields();
            });

            // Add fields function
            function addFields() {
                $('#dynamicFieldsContainer').append(`
                    <div class="row mb-3 dynamic-entry">
                        <div class="col-md-5">
                            <label for="order_no">Order No.</label>
                            <input type="number" name="order_nos[]" class="form-control" placeholder="Order No.">
                        </div>
                        <div class="col-md-5">
                            <label for="price">Price</label>
                            <input type="number" name="prices[]" class="form-control" placeholder="Price">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-success add-entry">+</button>
                        </div>
                    </div>
                `);
            }

            // Event delegation for dynamic add-entry button
            $('#dynamicFieldsContainer').on('click', '.add-entry', function() {
                let parent = $(this).closest('.dynamic-entry');
                let newEntry = parent.clone();
                newEntry.find('input').val(''); // Clear inputs in the cloned row
                newEntry.find('.add-entry').removeClass('btn-success add-entry').addClass('btn-danger remove-entry').text('-');
                $('#dynamicFieldsContainer').append(newEntry);
            });

            // Event delegation for dynamic remove-entry button
            $('#dynamicFieldsContainer').on('click', '.remove-entry', function() {
                $(this).closest('.dynamic-entry').remove();
            });

            // Handle form submission with JSON data
            $("#priceManagementForm").submit(function(event) {
                event.preventDefault();
                var element = $(this);
                $("button[type=submit]").prop('disabled', true);

                // Collect data in JSON format
                let priceData = [];
                $('#dynamicFieldsContainer .dynamic-entry').each(function() {
                    let order_no = $(this).find('input[name="order_nos[]"]').val();
                    let price = $(this).find('input[name="prices[]"]').val();

                    if (order_no && price) {
                        priceData.push({ order_no: order_no, price: price });
                    }
                });

                $.ajax({
                    url: '{{ route("price-managements.store") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        label: $('#label').val(),
                        price_type: $('#price_type').val(),
                        price_data: JSON.stringify(priceData)
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("button[type=submit]").prop('disabled', false);
                        if (response.status) {
                            window.location.href = "{{ route('price-managements.index') }}";
                        } else {
                            // Handle validation errors (e.g., label errors)
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
