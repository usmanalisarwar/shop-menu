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
                                <label for="category_id">Category<span class="text-danger">*</span></label>
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
                                <label for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                <p></p>
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4"></textarea>
                                <p></p>
                            </div>
                        </div>
                        <!-- Label Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="label">Price Type<span class="text-danger">*</span></label>
                                <select name="label" id="label" class="form-control">
                                    <option value="">Select Price Type</option>
                                    @foreach($labels as $label)
                                        <option value="{{ $label->id }}">{{ $label->label }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                            </div>
                        </div>
                        <!-- Label Field (Dynamic Value from price_management_details table) -->
                        <div class="col-md-6" id="label-field" style="display: none;">
                            <div class="mb-3">
                                <label for="dynamic_label">Label</label>
                                <input type="text" name="dynamic_label" id="dynamic_label" class="form-control" placeholder="Label" readonly>
                            </div>
                        </div>


                        <!-- Price Field (Initially Null) -->
                        <div class="col-md-6" id="price-field" style="display: none;">
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Price" value="">
                            </div>
                        </div>


                         <!-- Media Images Dropzone -->
                        <div class="col-md-12">  
                            <div class="card mb-3 d-none">
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
$(document).ready(function () {
     $('#label').on('change', function () {
        var selectedLabel = $(this).val();

        if (selectedLabel) {
            $.ajax({
                url: '{{ route("getPriceDetail", ["id" => ":id"]) }}'.replace(':id', selectedLabel),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        // Show fields and set the dynamic label value
                        $('#label-field').show();
                        $('#price-field').show();
                        $('#dynamic_label').val(response.priceDetails.label); // Set label value
                        $('#price').val(null); // Keep price field null
                    } else {
                        $('#label-field').hide();
                        $('#price-field').hide();
                    }
                },
                error: function() {
                    $('#label-field').hide();
                    $('#price-field').hide();
                }
            });
        } else {
            $('#label-field').hide();
            $('#price-field').hide();
        }
    });

});


$("#menuItemForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{ route("menu-items.store") }}',
        type: 'POST',
        data: element.serialize(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response.status){
                window.location.href = "{{ route('menu-items.index') }}";
            } else {
                var errors = response.errors;
                if(errors.category_id){
                    $("#category_id").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category_id);
                } else {
                    $("#category_id").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if(errors.title){
                    $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                } else {
                    $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if(errors.description){
                    $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                } else {
                    $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if(errors.label){
                    $("#label").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.label);
                } else {
                    $("#label").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }

            }
        },
        error: function(jqXHR, exception){
            console.log("Something went wrong");
        }
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
