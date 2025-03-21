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
				@if(hasPermissions(getAuthUserModulePermissions(), 'add-new-menu')) <a href="{{route('menus.create')}}" class="btn btn-primary">New Menu</a>
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
								{{-- Display the first image with a tooltip --}}
								<a href="javascript:void(0);" onclick="showImageModal({{ $menu->id }})"
									data-toggle="tooltip" title="This is the first menu page this menu page show on bar code page">
									<img src="{{ asset('uploads/menu/' . $menu->images->first()->image) }}" alt="{{ $menu->title }}" width="50" height="50"> </a>
								@else
								<p>No image available</p>
								@endif
							</td>

							<td>
								<button onclick="copyLink('{{ route('generate.qrcode', $menu->slug) }}')" class="btn btn-warning btn-sm mr-1"> <!-- Add btn-sm for small size -->
								Copy QR Code Link
							    </button>
							    <a href="{{ route('menus.pdf', $menu->id) }}" target="_blank" class="btn btn-secondary">
							        Generate PDF
							    </a>
							    @if(hasPermissions(getAuthUserModulePermissions(), 'edit-menu'))						
							        <a href="{{ route('menus.edit', $menu->id) }}">
							            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
							            </svg>
							        </a>
							    @endif
							    @if(hasPermissions(getAuthUserModulePermissions(), 'delete-menu'))		
							        <a onclick="deleteMenu({{ $menu->id }})" class="text-danger w-4 h-4 mr-1">
							            <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
							            </svg>
							        </a>
							    @endif
							</td>

						</tr>
						@endforeach
						@else
						<td colspan="7" class="text-center"> <!-- span across 7 columns, text centered -->
							<strong>No Records Found</strong>
						</td>
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

@endsection

@section('customJs')
<script>
	// $(document).ready(function() {
	// 	$('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips
	// });
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips
});
</script>
<script type="text/javascript">
	function deleteMenu(id) {
		var url = '{{ route("menus.delete", ":id") }}';
		url = url.replace(':id', id);

		if (confirm("Are you sure you want to delete this menu?")) {
			// Disable button to prevent multiple clicks
			$('a[onclick="deleteMenu(' + id + ')"]').attr('disabled', 'disabled');

			$.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    location.reload(); 
                } else {
                    alert('Failed to delete the menu.');
                }
            },
            error: function(xhr) {
                alert('An error occurred while trying to delete the menu.');
                console.log(xhr.responseText);
            },
            complete: function() {
                // Enable button again after processing
                $('a[onclick="deleteMenu('+id+')"]').removeAttr('disabled');
            }
        });
    }
	}

	function copyLink(link) {
    navigator.clipboard.writeText(link).then(function() {
        alert('QR Code link copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection