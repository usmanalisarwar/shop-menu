@extends('admin.layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Menu Items</h1>
			</div>
			<div class="col-sm-6 text-right">
				@if(hasPermissions(getAuthUserModulePermissions(), 'add-new-menu-item')) 
				<a href="{{ route('menu-items.create') }}" class="btn btn-primary">New Menu Item</a>
				@endif
			</div>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		@include('admin.message')
		<div class="card">
			<form action="" method="get">
				<div class="card-header">
					<div class="card-title">
						<button type="button" onclick="window.location.href='{{ route("menu-items.index") }}'" class="btn btn-default btn-sm">Refresh</button>
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
							<th>Category</th> <!-- Category name column -->
							<th>Price</th>    <!-- Price column -->
							<th>Quantity</th>
							<th>Image</th>
							<th width="100">Action</th>
						</tr>
					</thead>
					<tbody>
                        @if($menuItems->isNotEmpty())
                        @foreach($menuItems as $menu)
                        <tr>
							<td>{{ $menu->id }}</td>
							<td>{{ $menu->title }}</td>
							<td>{{ $menu->category->name ?? 'Uncategorized' }}</td> <!-- Show category name or default to 'Uncategorized' -->
							<td>{{ number_format($menu->price, 2) }}</td> <!-- Format price with two decimals -->
							<td>{{ $menu->quantity }}</td>
							<td>
							    @if($menu->images->isNotEmpty())
							        <a href="javascript:void(0);" onclick="showImageModal({{ $menu->id }})">
							            <img src="{{ asset('uploads/menuItem/' . $menu->images->first()->image) }}" alt="{{ $menu->title }}" width="50" height="50">
							        </a>
							    @else
							        <p>No image available</p>
							    @endif
							</td>

							<td>
								@if(hasPermissions(getAuthUserModulePermissions(), 'edit-menu-item'))
									<a href="{{ route('menu-items.edit', $menu->id) }}">
										<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
										</svg>
									</a>
								@endif
								
								@if(hasPermissions(getAuthUserModulePermissions(), 'delete-menu-item'))
									<a onclick="deleteMenuItem({{ $menu->id }})" class="text-danger w-4 h-4 mr-1">
										<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
			        <ul class="pagination justify-content-end">
			            {{-- Previous Page Link --}}
			            <li class="page-item {{ $menuItems->onFirstPage() ? 'disabled' : '' }}">
			                <a class="page-link" href="{{ $menuItems->previousPageUrl() }}" aria-label="Previous">
			                    <span aria-hidden="true">&laquo;</span>
			                </a>
			            </li>

			            {{-- Pagination Elements --}}
			            @foreach ($menuItems->getUrlRange(1, $menuItems->lastPage()) as $page => $url)
			                <li class="page-item {{ $page == $menuItems->currentPage() ? 'active' : '' }}">
			                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
			                </li>
			            @endforeach

			            {{-- Next Page Link --}}
			            <li class="page-item {{ $menuItems->hasMorePages() ? '' : 'disabled' }}">
			                <a class="page-link" href="{{ $menuItems->nextPageUrl() }}" aria-label="Next">
			                    <span aria-hidden="true">&raquo;</span>
			                </a>
			            </li>
			        </ul>
			    </nav>
			</div>

			<!-- End of Pagination -->
		</div>
	</div>
</section>

@endsection

@section('customJs')
<script>
function deleteMenuItem(id) {
    var url = '{{ route("menu-items.delete", "ID") }}';
    var newUrl = url.replace("ID", id);
    if (confirm("Are you sure you want to delete")) {
        $.ajax({
            url: newUrl,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    window.location.href = "{{ route('menu-items.index') }}";
                }
            }
        });
    }
}

</script>
@endsection
