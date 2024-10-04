@extends('admin.layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" id="categoryForm" name="categoryForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" placeholder="Name">
                                <p></p>
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Block</option>
                                </select>
                            </div>
                        </div>

                        <!-- Parent Category Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                            </div>
                        </div>

                        <!-- Subcategories will load dynamically -->
                        <div id="subcategory-container" class="row"></div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
   $(document).ready(function () {
    // Attach event listener to the main category dropdown (parent category)
    $('#parent_id').on('change', function () {
        let parent_id = $(this).val();
        
        // Clear all subcategories when the parent category changes
        $('#subcategory-container').empty();

        if (parent_id) {
            loadSubCategories(parent_id, 1); // Load subcategories for the new parent_id (Level 1)
        }
    });

    // If editing and there is a parent category, load the subcategories for that category
    @if($category->parent_id)
        loadSubCategories({{ $category->parent_id }}, 1);
    @endif
});

function loadSubCategories(parent_id, level) {
    if (parent_id) {
        $.ajax({
            url: "{{ route('categories.subcategories') }}",
            type: 'GET',
            data: { parent_id: parent_id },
            success: function (response) {
                if (response.status) {
                    // Remove all subcategory dropdowns from the current level onward
                    $('#subcategory-container').find(`[data-level="${level}"]`).nextAll().remove();

                    // If there are subcategories, append a new dropdown
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

                        // Append the new subcategory dropdown inside the container
                        $('#subcategory-container').append(subCategoryDropdown);

                        // Attach an event listener to the new subcategory dropdown
                        $(`#subcategory_${level}`).on('change', function () {
                            const selectedValue = $(this).val();
                            if (selectedValue) {
                                // Load next subcategory level dynamically
                                loadSubCategories($(this).val(), level + 1);
                            } else {
                                // If unselected, remove all subsequent subcategories
                                $('#subcategory-container').find(`[data-level="${level}"]`).nextAll().remove();
                            }
                        });
                    }
                }
            }
        });
    } else {
        // If no category is selected, remove all subcategory dropdowns after the current level
        $('#subcategory-container').find(`[data-level="${level - 1}"]`).nextAll().remove();
    }
}


$("#categoryForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url: '{{ route("categories.update", $category->id) }}',
        type: 'POST',
        data: element.serialize(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response.status){
                window.location.href = "{{ route('categories.index') }}";
            } else {
                var errors = response.errors;
                if(errors.name){
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                } else {
                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if(errors.slug){
                    $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.slug);
                } else {
                    $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
            }
        },
        error: function(jqXHR, exception){
            console.log("Something went wrong");
        }
    });
});

</script>
@endsection
