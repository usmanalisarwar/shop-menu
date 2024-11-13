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
                <h1>Edit Menu Item</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('menu-items.index') }}" class="btn btn-primary">Back</a>
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
        @if (hasPermissions($permissions, 'edit-menu-item'))
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
                                    <option value="" disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $menuItem->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                            </div>
                        </div>
                        <!-- Title Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title', $menuItem->title) }}">
                                <p></p>
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4">{{ old('description', $menuItem->description) }}</textarea>
                            </div>
                        </div>
                      <!-- Price Type Dropdown -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="price_type">Price Type</label>
                                <select name="price_type" id="price_type" class="form-control">
                                    <option value="">Select Price Type</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Quantity->value }}" {{ $menuItem->price_type == App\Enums\PriceTypeEnum::Quantity->value ? 'selected' : '' }}>Quantity</option>
                                    <option value="{{ App\Enums\PriceTypeEnum::Size->value }}" {{ $menuItem->price_type == App\Enums\PriceTypeEnum::Size->value ? 'selected' : '' }}>Size</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dynamic Fields Container -->
                        <div id="dynamicFieldsContainer" class="col-md-12">
                            <!-- Existing price data will be populated here dynamically -->
                            @foreach(json_decode($menuItem->data) ?? [] as $priceData)
                                <div class="row mb-3 dynamic-entry">
                                    <div class="col-md-5">
                                        <label for="label">Label</label>
                                        <select name="labels[]" class="form-control">
                                            <option value="" selected disabled>Select Label</option>
                                            @foreach($labels as $label)
                                                <option value="{{ $label->label }}" {{ $label->label == $priceData->label ? 'selected' : '' }}>{{ $label->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="price">Price</label>
                                        <input type="number" name="prices[]" class="form-control" value="{{ $priceData->price }}" placeholder="Price">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-success add-entry">+</button>
                                        <button type="button" class="btn btn-danger remove-entry ml-2">-</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Media Images Dropzone -->
                        <div class="col-md-12">  
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Media</h2>                              
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>                                                                        
                            </div>
                        </div>
                        <!-- Image Gallery -->
                        <div class="row" id="menu-gallery" class="sortable-gallery">
                            @foreach($menuItemImages as $image)
                                <div class="col-md-4 image-row" id="image-row-{{ $image->id }}" data-id="{{ $image->id }}">
                                    <input type="hidden" name="image_array[]" value="{{ $image->id }}">
                                    <div class="card">
                                        <img src="{{ asset('uploads/menuItem/' . $image->image) }}" class="card-img-top img-fluid" alt="">
                                        <div class="card-body text-center">
                                            <span class="image-number">{{ $loop->index + 1 }}</span>
                                            <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('menu-items.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
                    <label for="label">Label.</label>
                    <select name="labels[]" class="form-control">
                        <option value="" selected disabled>Select Label</option>
                        @foreach($labels as $label)
                            <option value="{{ $label->label }}">{{ $label->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="price">Price</label>
                    <input type="number" name="prices[]" class="form-control" placeholder="Price">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-success add-entry">+</button>
                    <button type="button" class="btn btn-danger remove-entry ml-2">-</button>
                </div>
            </div>
        `);
    }

    // Event delegation for dynamic add-entry button
    $('#dynamicFieldsContainer').on('click', '.add-entry', function() {
        let parent = $(this).closest('.dynamic-entry');
        let newEntry = parent.clone();
        newEntry.find('input').val(''); // Clear inputs in the cloned row
        $('#dynamicFieldsContainer').append(newEntry);
    });

    // Event delegation for dynamic remove-entry button
    $('#dynamicFieldsContainer').on('click', '.remove-entry', function() {
        $(this).closest('.dynamic-entry').remove();
    });

    // Handle form submit via AJAX
    $('#menuItemForm').submit(function(event) {
        event.preventDefault();  // Prevent default form submission

        // Collect data
        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            category_id: $('#category_id').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            price_type: $('#price_type').val(),
            price_data: JSON.stringify(getPriceData()),
            image_array: getImageArray()
        };

        // Send AJAX request
        $.ajax({
            url: '{{ route("menu-items.update", $menuItem->id) }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    window.location.href = "{{ route('menu-items.index') }}";
                } else {
                    // Handle validation errors or any issues from the server
                    alert('Something went wrong.');
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });
    });

    // Function to get the price data from the form
    function getPriceData() {
        var priceData = [];
        $('input[name="prices[]"]').each(function(index) {
            var label = $('select[name="labels[]"]')[index].value;
            var price = $(this).val();
            priceData.push({ label: label, price: price });
        });
        return priceData;
    }

    // Function to get image array from the gallery
    function getImageArray() {
        var imageData = [];
        $("#menu-gallery .image-row").each(function() {
            imageData.push($(this).data('id'));
        });
        return imageData;
    }
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
                updateImageNumbers(); // Update the numbering after sorting
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
            updateImageNumbers(); // Update numbers after deletion
        }
    </script>
@endsection
