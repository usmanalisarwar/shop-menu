@extends('admin.layouts.app')
@section('content')
<style type="text/css">
    .card-img-top {
        width: 100%; /* Make sure the image takes the full width of the card */
        height: auto; /* Maintain aspect ratio */
        position: relative;
    }
    .image-row {
        margin-bottom: 15px; /* Add spacing between rows */
    }
    .image-overlay-text {
        position: absolute;
        top: 50%; 
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 16px;
        background: rgba(0, 0, 0, 0.6); /* Semi-transparent black background */
        padding: 5px 10px;
        border-radius: 5px;
        text-align: center;
        display: none; /* Hidden for all except the first image */
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Menu</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('menus.index') }}" class="btn btn-primary">Back</a>
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
        @if (hasPermissions($permissions, 'edit-menu'))
        <form action="" method="POST" id="menuForm" name="menuForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $menu->title }}" placeholder="Title">
                                <p></p>
                            </div>
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
                            @foreach($menuImages as $image)
                                <div class="col-md-4 image-row" id="image-row-{{ $image->id }}" data-id="{{ $image->id }}">
                                    <input type="hidden" name="image_array[]" value="{{ $image->id }}">
                                    <div class="card">
                                        <div class="image-container" style="position: relative;">
                                            <img src="{{ asset('uploads/menu/' . $image->image) }}" class="card-img-top img-fluid" alt="">
                                            <!-- Add the overlay text, but only display it for the first image -->
                                            <div class="image-overlay-text" style="display: {{ $loop->first ? 'block' : 'none' }}">
                                                First page of menu and this first menu page also show on bar code page
                                            </div>
                                        </div>
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
                <a href="{{ route('menus.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
        @endif
    </div>
</section>
@endsection

@section('customJs')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
$("#menuForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{ route("menus.update", $menu->id) }}',
        type: 'POST',
        data: element.serialize(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response.status){
                window.location.href = "{{ route('menus.index') }}";
            } else {
                var errors = response.errors;
                if(errors.title){
                    $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                } else {
                    $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if(errors.image){
                    $("#image").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.image);
                } else {
                    $("#image").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
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
        updateImageNumbers(); // Update the numbering after sorting
    }
});

// Update the image numbers after sorting or deleting
function updateImageNumbers() {
    $('#menu-gallery .image-row').each(function (index, element) {
        $(element).find('.image-number').text(index + 1);
        
        // Check if it's the first image and display the overlay text
        if (index === 0) {
            $(element).find('.image-overlay-text').show(); // Show text on the first image
        } else {
            $(element).find('.image-overlay-text').hide(); // Hide text on other images
        }
    });
}

// Call this function on page load to update numbers and display overlay on the first image
$(document).ready(function() {
    updateImageNumbers(); // Initialize correct overlay display for loaded images
});


function deleteImage(id){
    $("#image-row-" + id).remove();
    updateImageNumbers(); // Update numbers after deletion
}
</script>
@endsection
