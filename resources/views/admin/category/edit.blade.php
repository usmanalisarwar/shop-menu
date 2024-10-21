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
        @php
            $permissions = getAuthUserModulePermissions();
        @endphp
        @if (hasPermissions($permissions, 'edit-category'))
        <form action="" method="POST" id="categoryForm" name="categoryForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $category->name) }}">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Block</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- User (User ID) Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">Select a User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $category->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                            </div>
                        </div>
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
                        <div id="subcategory-container" class="row"></div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
        @endif
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function () {
    // Load existing subcategories based on the selected parent category
    loadExistingSubCategories("{{ $category->parent_id }}", {{ old('parent_id', $category->parent_id) ? 1 : 0 }});

    // Attach event listener to the main category dropdown
    $('#parent_id').on('change', function () {
        let parent_id = $(this).val();
        loadSubCategories(parent_id, 1); // Level 1 is the first subcategory level
    });
});

// Function to load existing subcategories
function loadExistingSubCategories(parent_id, level) {
    if (parent_id) {
        $.ajax({
            url: "{{ route('categories.subcategories') }}",
            type: 'GET',
            data: { parent_id: parent_id },
            success: function (response) {
                if (response.status) {
                    // Add existing subcategory dropdowns based on the response
                    response.subCategories.forEach((subCat, index) => {
                        let subCategoryDropdown = createSubcategoryDropdown(subCat.id, level, response.subCategories);
                        $('#subcategory-container').append(subCategoryDropdown);
                    });
                }
            }
        });
    }
}

function createSubcategoryDropdown(selectedId, level, subCategories) {
    return `
        <div class="col-md-6 mb-3" data-level="${level}">
            <label for="subcategory_${level}">Subcategory Level ${level + 1}</label>
            <select name="subcategory_${level}" id="subcategory_${level}" class="form-control">
                <option value="">Select Subcategory Level ${level + 1}</option>
                ${subCategories.map(cat => `<option value="${cat.id}" ${cat.id == selectedId ? 'selected' : ''}>${cat.name}</option>`).join('')}
            </select>
        </div>
    `;
}

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
                        let subCategoryDropdown = createSubcategoryDropdown('', level, response.subCategories);
                        $('#subcategory-container').append(subCategoryDropdown);

                        // Attach an event listener to the new subcategory dropdown
                        $(`#subcategory_${level}`).on('change', function () {
                            loadSubCategories($(this).val(), level + 1); // Recursive loading of next subcategory level
                        });
                    }
                }
            }
        });
    } else {
        // If no category is selected, clear all subcategory dropdowns
        $('#subcategory-container').empty();
    }
}

// Handle form submission with AJAX
$("#categoryForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled', true);
    $.ajax({
        url: '{{ route("categories.update", $category->id) }}',
        type: 'POST',
        data: element.serialize(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled', false);
            if(response.status){
                window.location.href = "{{ route('categories.index') }}";
            } else {
                handleErrors(response.errors);
            }
        },
        error: function(jqXHR, exception){
            console.log("Something went wrong");
        }
    });
});



</script>
@endsection
