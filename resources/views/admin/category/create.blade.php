@extends('admin.layouts.app')
@section('content')

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
        <form action="{{ route('categories.store') }}" method="POST" id="categoryForm" name="categoryForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
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
                                <p></p>
                            </div>
                        </div>
                        <div id="subcategory-container" class="row"></div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>

@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
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
        // Add other field validations as needed
    }
</script>
@endsection
