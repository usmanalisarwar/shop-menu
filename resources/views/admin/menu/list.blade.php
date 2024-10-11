@extends('admin.layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Menus</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('menus.pdfAll') }}" target="_blank" class="btn btn-secondary">
                    Generate Menus PDF
                </a>
                @php
                    $permissions = getAuthUserModulePermissions(); // Get user permissions
                @endphp
                @if(hasPermissions($permissions, 'add-new-menu'))
				<a href="{{route('menus.create')}}" class="btn btn-primary">New Menu</a>
				@endif
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
		@include('admin.message')
		<div class="card">
			<form action="" method="get">
				<div class="card-header">
					<div class="card-title">
						<button type="button" onclick="window.location.href='{{route("menus.index")}}'" class="btn btn-default btn-sm">Refresh</button>
					</div>
					<div class="card-tools">
						<div class="input-group" style="width: 250px;">
							<input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
							<div class="input-group-append">
								<button type="submit" class="btn btn-default">
									<i class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</div>                
				</div>
			</form>
			<div class="card-body table-responsive p-0">								
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th width="60">ID</th>
							<th>Title</th>
							<th>Image</th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
                        @if($menus->isNotEmpty())
                        @foreach($menus as $menu)
                        <tr>
							<td>{{$menu->id}}</td>
							<td>{{$menu->title}}</td>
							<td>
								@if($menu->images->isNotEmpty())
				                    {{-- Display the first image and make it clickable --}}
									<a href="javascript:void(0);" onclick="showImageModal({{ $menu->id }})">
										<img src="{{ asset('uploads/menu/' . $menu->images->first()->image) }}" alt="{{ $menu->title }}" width="50" height="50">
									</a>
				                @else
				                    <p>No image available</p>
				                @endif
				            </td>
							<td>
								 <a href="{{ route('menus.pdf', $menu->id) }}" target="_blank" class="btn btn-secondary">
					                Generate PDF
					            </a>
					            @if(hasPermissions($permissions, 'edit-menu'))
								<a href="{{route('menus.edit',$menu->id)}}">
									<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
									</svg>
								</a>
								@endif
								@if(hasPermissions($permissions, 'delete-menu'))
								<a onclick="deleteMenu({{$menu->id}})" class="text-danger w-4 h-4 mr-1">
									<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
								  	</svg>
								</a>
								@endif
							</td>
						</tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">Records Not Found</td>
                        </tr>
                        @endif
					</tbody>
				</table>										
			</div>
			<!-- Pagination -->
			<div class="card-footer clearfix">
				<nav aria-label="Page navigation">
					<ul class="pagination justify-content-end"> <!-- Align to right -->
						{{-- Previous Page Link --}}
						<li class="page-item {{ $menus->onFirstPage() ? 'disabled' : '' }}">
							<a class="page-link" href="{{ $menus->previousPageUrl() }}" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>

						{{-- Pagination Elements --}}
						@foreach ($menus->getUrlRange(1, $menus->lastPage()) as $page => $url)
							<li class="page-item {{ $page == $menus->currentPage() ? 'active' : '' }}">
								<a class="page-link" href="{{ $url }}">{{ $page }}</a>
							</li>
						@endforeach

						{{-- Next Page Link --}}
						<li class="page-item {{ $menus->hasMorePages() ? '' : 'disabled' }}">
							<a class="page-link" href="{{ $menus->nextPageUrl() }}" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<!-- End of Pagination -->
		</div>
	</div>
	<!-- /.card -->
</section>
<!-- /.content -->

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Menu Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" id="carouselImages">
            <!-- Images will be injected here via JavaScript -->
          </div>
          <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

@section('customJs')
<script>
function deleteMenu(id) {
    var url = '{{ route("menus.delete", ":id") }}';
    url = url.replace(':id', id);
    
    if (confirm("Are you sure you want to delete this menu?")) {
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Failed to delete the menu.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while trying to delete the menu.');
                console.log(xhr.responseText);
            }
        });
    }
}

function showImageModal(menuId) {
    $.ajax({
        url: '/menus/' + menuId + '/images',
        type: 'GET',
        success: function(response) {
            var images = response.images;
            var carouselInner = $('#carouselImages');
            carouselInner.empty();

            if (images.length) {
                images.forEach(function(image, index) {
                    var activeClass = index === 0 ? 'active' : '';
                    var carouselItem = `
                        <div class="carousel-item ${activeClass}">
                            <img src="/uploads/menu/${image.image}" class="d-block w-100" alt="${image.name}">
                            <div class="carousel-caption d-none d-md-block">
                                <p>Sort Order: ${index + 1}</p>
                            </div>
                        </div>
                    `;
                    carouselInner.append(carouselItem);
                });
                $('#imageModal').modal('show');
            } else {
                alert('No images found for this menu.');
            }
        },
        error: function(xhr) {
            alert('Failed to load images.');
            console.log(xhr.responseText);
        }
    });
}

</script>
@endsection

