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
                                <label for="label">Label<span class="text-danger">*</span></label>
                                <input type="text" name="label" id="label" class="form-control" placeholder="Label">
                                <p class="text-danger invalid-feedback" id="label-error"></p> <!-- Error message -->
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4"></textarea>
                                <p class="text-danger invalid-feedback" id="description-error"></p> <!-- Error message -->
                            </div>
                        </div>

                        <!-- Price Type Dropdown -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="price_type">Price Type<span class="text-danger">*</span></label>
                                <select name="price_type" id="price_type" class="form-control">
                                    <option value="">Select Price Type</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Quantity->value }}">Quantity</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Size->value }}">Size</option>
                                </select>
                                <p class="text-danger invalid-feedback" id="price_type-error"></p> <!-- Error message -->
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
        addFields(); // Add initial field with both add and remove buttons
    });

    // Add fields function
    function addFields() {
        $('#dynamicFieldsContainer').append(`
            <div class="row mb-3 dynamic-entry">
                <div class="col-md-5">
                    <label for="order_no">Order No.<span class="text-danger">*</span></label>
                    <input type="number" name="order_nos[]" class="form-control order-no" placeholder="Order No.">
                    <small class="text-danger order-no-error" style="display: none;">This Order No. is already taken.</small>
                </div>
                <div class="col-md-5">
                    <label for="label">Label<span class="text-danger">*</span></label>
                    <input type="text" name="labels[]" class="form-control" placeholder="Label">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-success add-entry mr-2">+</button>
                    <button type="button" class="btn btn-danger remove-entry">-</button>
                </div>
            </div>
        `);
    }

    // Event delegation for dynamic add-entry button
    $('#dynamicFieldsContainer').on('click', '.add-entry', function() {
        let parent = $(this).closest('.dynamic-entry');
        let newEntry = parent.clone();
        newEntry.find('input').val(''); // Clear inputs in the cloned row
        newEntry.find('.order-no-error').hide(); // Hide error message in cloned row
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
        let hasDuplicateError = false;

        $('#dynamicFieldsContainer .dynamic-entry').each(function() {
            let order_no = $(this).find('input[name="order_nos[]"]').val();
            let label = $(this).find('input[name="labels[]"]').val();

            // Check if the error message is visible for any duplicate
            if ($(this).find('.order-no-error').is(':visible')) {
                hasDuplicateError = true;
            }

            if (order_no && label) {
                priceData.push({ order_no: order_no, label: label });
            }
        });

        if (hasDuplicateError) {
            $("button[type=submit]").prop('disabled', false);
            return; // Prevent form submission if there are duplicate errors
        }

        $.ajax({
            url: '{{ route("price-managements.store") }}',
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
                    var errors = response.errors;
                    //show error if ordor number is already taken
                    // alert(response.message);
                    alert("Order_no is already taken");

                    
                    // Handle errors by displaying them
                    if (errors.label) {
                        $("#label").addClass('is-invalid').siblings('p').html(errors.label).show();
                    } else {
                        $("#label").removeClass('is-invalid').siblings('p').hide();
                    }
                    
                    if (errors.description) {
                        $("#description").addClass('is-invalid').siblings('p').html(errors.description).show();
                    } else {
                        $("#description").removeClass('is-invalid').siblings('p').hide();
                    }

                    if (errors.price_type) {
                        $("#price_type").addClass('is-invalid').siblings('p').html(errors.price_type).show();
                    } else {
                        $("#price_type").removeClass('is-invalid').siblings('p').hide();
                    }
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
