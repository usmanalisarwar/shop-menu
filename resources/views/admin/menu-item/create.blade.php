@extends('admin.layouts.app')
@section('content')
<style type="text/css">
    .card-img-top {
        width: 100%;
        height: auto;
    }
    .image-row {
        margin-bottom: 15px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Menu Item</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('menu-items.index')}}" class="btn btn-primary">Back</a>
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
        @if (hasPermissions($permissions, 'add-new-menu-item'))
        <form action="" method="POST" id="menuItemForm" name="menuItemForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Category Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                            </div>
                        </div>
                        
                        <!-- Title Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                <p></p>
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
                         <!-- Media Images Dropzone -->
                        <div class="col-md-12">  
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Media</h2>                              
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drop files here or click to upload.<br><br>     <p></p>          
                                        </div>
                                    </div>
                                </div>                                                                        
                            </div>
                        </div>
                        <!-- Image Gallery -->
                        <div class="row" id="menu-gallery" class="sortable-gallery"></div>
                    </div>
                </div>
            </div>
            
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('menu-items.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
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
        updateTotalPrice(); // Update the total price when price type changes
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
                    <input type="number" name="prices[]" class="form-control" placeholder="Price" oninput="updateTotalPrice()">
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
        updateTotalPrice(); // Update the total price after adding a new entry
    });

    // Event delegation for dynamic remove-entry button
    $('#dynamicFieldsContainer').on('click', '.remove-entry', function() {
        $(this).closest('.dynamic-entry').remove();
        updateTotalPrice(); // Update the total price after removing an entry
    });

    // Function to calculate the total price
    function updateTotalPrice() {
        let totalPrice = 0;
        // Sum up all the prices entered in the dynamic fields
        $('#dynamicFieldsContainer .dynamic-entry').each(function() {
            let price = $(this).find('input[name="prices[]"]').val();
            if (price) {
                totalPrice += parseFloat(price);
            }
        });
        // Update the "Prices" field with the total price
        $('#prices').val(totalPrice.toFixed(2)); // Display total price rounded to 2 decimal places
    }

    // Handle form submission with JSON data
    $("#menuItemForm").submit(function(event) {
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
        var imageData = [];
        $("#menu-gallery .image-row").each(function() {
            imageData.push($(this).data('id'));
        });

        $.ajax({
            url: '{{ route("menu-items.store") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                category_id: $('#category_id').val(),
                title: $('#title').val(),
                description: $('#description').val(),
                price_type: $('#price_type').val(),
                price_data: JSON.stringify(priceData),
                image_array: imageData
            },
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status) {
                    window.location.href = "{{ route('menu-items.index') }}";
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


        // Dropzone setup for media images
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url: "{{ route('menu-item-images.menuItemCreate') }}",
            maxFiles: 10,
            paramName: 'image',
            acceptedFiles: "image/jpeg,image/png,image/gif",
            thumbnailWidth: 300,
            thumbnailHeight: 275,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                if (response.status) {
                    const existingImages = $('#menu-gallery .image-row').map(function() {
                        return $(this).data('id');
                    }).get();

                    if (existingImages.includes(response.image_id)) {
                        this.removeFile(file);
                        return;
                    }

                    var html = `
                        <div class="col-md-4 image-row" id="image-row-${response.image_id}" data-id="${response.image_id}">
                            <input type="hidden" name="image_array[]" value="${response.image_id}">
                            <div class="card">
                                <img src="${response.ImagePath}" class="card-img-top img-fluid" alt="" style="width: 100%; height: auto;"> 
                                <div class="card-body text-center">
                                    <span class="image-number">${$('.image-row').length + 1}</span>
                                    <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>`;
                    $("#menu-gallery").append(html);
                    updateImageNumbers();
                }
            },
            complete: function(file){
                this.removeFile(file);
            }
        });

        // Initialize Sortable for image swapping
        const gallery = document.getElementById('menu-gallery');
        Sortable.create(gallery, {
            animation: 150,
            onEnd: function (evt) {
                updateImageNumbers();
            }
        });

        // Update the image numbers after sorting or deleting
        function updateImageNumbers() {
            $('#menu-gallery .image-row').each(function (index, element) {
                $(element).find('.image-number').text(index + 1);
            });
        }

        function deleteImage(id){
            $("#image-row-" + id).remove();
            updateImageNumbers();
        }

    </script>
@endsection
