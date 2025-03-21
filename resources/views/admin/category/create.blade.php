@extends('admin.layouts.app')

@section('content')
<style type="text/css">
    .card-img-top {
        width: 100%; /* Make sure the image takes the full width of the card */
        height: auto; /* Maintain aspect ratio */
    }
    .image-row {
        margin-bottom: 15px; /* Add spacing between rows */
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
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
        @if (hasPermissions($permissions, 'add-new-category'))
        <form action="" method="POST" id="categoryForm" name="categoryForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="order_no">Order No<span class="text-danger">*</span></label>
                                <input type="number" name="order_no" id="order_no" class="form-control" placeholder="Order No">
                                <p></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="subcategory-container" class="row"></div>

                        <!-- Media Images Dropzone -->
                        <div class="col-md-12">  
                            <div class="card mb-3 d-none">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Media</h2>                              
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drop files here or click to upload.<br><br>                               <p></p>          
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
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
        // Initialize Summernote
        $('.summernote').summernote({
            height: 250 // Set the editor height
        });

        $('#parent_id').on('change', function () {
            let parent_id = $(this).val();
            loadSubCategories(parent_id, 1);
        });
    });

    function loadSubCategories(parent_id, level) {
        if (parent_id) {
            $.ajax({
                url: "{{ route('categories.subcategories') }}",
                type: 'GET',
                data: { parent_id: parent_id },
                success: function (response) {
                    if (response.status) {
                        $('#subcategory-container').find(`[data-level="${level}"]`).nextAll().remove();
                        if (response.subCategories.length > 0) {
                            let subCategoryDropdown = `
                                <div class="col-md-6 mb-3" data-level="${level}">
                                    <label for="subcategory_${level}">Subcategory Level ${level + 1}</label>
                                    <select name="subcategory_${level}" id="subcategory_${level}" class="form-control">
                                        <option value="">Select Subcategory Level ${level + 1}</option>
                                        ${response.subCategories.map(cat => `<option value="${cat.id}">${cat.name}</option>`).join('')}
                                    </select>
                                </div>
                            `;
                            $('#subcategory-container').append(subCategoryDropdown);
                            $(`#subcategory_${level}`).on('change', function () {
                                loadSubCategories($(this).val(), level + 1);
                            });
                        }
                    }
                }
            });
        } else {
            $('#subcategory-container').empty();
        }
    }

    $("#categoryForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("categories.store") }}',
            type: 'POST',
            data: element.serialize(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response.status){
                    window.location.href = "{{ route('categories.index') }}";
                } else {
                    handleValidationErrors(response.errors);
                }
            },
            error: function(jqXHR, exception){
                console.log("Something went wrong");
                $("button[type=submit]").prop('disabled', false);
            }
        });
    });

    function handleValidationErrors(errors) {
        // Clear previous errors
        $(".is-invalid").removeClass('is-invalid');
        $("p.invalid-feedback").removeClass('invalid-feedback').html("");

        if (errors.name) {
            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
        }
        if (errors.order_no) {
            $("#order_no").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.order_no);
        }
        // Add other field validations as needed
    }

// Dropzone setup for media images
Dropzone.autoDiscover = false;
const dropzone = $("#image").dropzone({
    url: "{{ route('category-images.categoryCreate') }}",
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
