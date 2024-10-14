@extends('admin.layouts.app')

@section('content')
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
    <!-- /.container-fluid -->
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
                                <input type="text" class="form-control" id="title" name="title" value="{{ $menu->title }}" required>
                                <p class="text-danger"></p>
                            </div>
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <label for="image">Images</label>
                        <div class="dropzone" id="image">
                            <div class="dz-message">Drop files here or click to upload.</div>
                            <p></p>
                        </div>
                        <input type="hidden" id="deleted_images" name="deleted_images" value="[]">
                    </div>

                    <div id="menu-gallery" class="row">
                        @foreach ($menuImages as $image)
                        <div class="col-md-4 image-row" id="image-row-{{ $image->id }}" data-id="{{ $image->id }}">
                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                            <div class="card">
                                <img src="{{ asset('uploads/menu/' . $image->image) }}" class="card-img-top" alt="" style="width: 100%; height: 275px;">
                                <div class="card-body text-center">
                                    <span class="image-number">{{ $loop->index + 1 }}</span>
                                    <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
</section>
@endsection


@section('customJs')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    let deletedImages = [];
    let updatedOrder = []; // Array to store updated order

    // Initialize Dropzone for image upload
    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        url: "{{ route('menu-images.create') }}",
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
                var html = `
                    <div class="col-md-4 image-row" id="image-row-${response.image_id}" data-id="${response.image_id}">
                        <input type="hidden" name="new_images[]" value="${response.image_id}">
                        <div class="card">
                            <img src="${response.ImagePath}" class="card-img-top" alt="" style="width: 100%; height: 275px;"> 
                            <div class="card-body text-center">
                                <span class="image-number">${$('.image-row').length + 1}</span>
                                <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>`;
                $("#menu-gallery").append(html);
                updateImageNumbers(); // Update numbers after adding image
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
            
            // Capture the new order
            updatedOrder = [];
            $('#menu-gallery .image-row').each(function (index, element) {
                const imageId = $(element).data('id');
                updatedOrder.push({ id: imageId, order_no: index + 1 });
            });
        }
    });

    // Update the image numbers after sorting or deleting
    function updateImageNumbers() {
        $('#menu-gallery .image-row').each(function (index, element) {
            $(element).find('.image-number').text(index + 1);
        });
    }

    // Delete an image
    function deleteImage(id) {
        deletedImages.push(id);
        $('#deleted_images').val(JSON.stringify(deletedImages));
        $("#image-row-" + id).remove();
        updateImageNumbers();
    }

    // Handle form submission
    $("#menuForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);

        // Add updated order to the data
        const formData = element.serializeArray();
        formData.push({ name: 'updated_order', value: JSON.stringify(updatedOrder) });

        $.ajax({
            url: '{{ route("menus.update", $menu->id) }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status) {
                    window.location.href = "{{ route('menus.index') }}";
                } else {
                    var errors = response.errors;
                    if (errors.title) {
                        $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                    } else {
                        $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                     if (errors.image) {
                        $("#image").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.image);
                    } else {
                        $("#image").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });
    });

</script>

@endsection
