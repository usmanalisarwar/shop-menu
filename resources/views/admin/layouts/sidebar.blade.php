<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="{{route('admin.dashboard')}}" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>																
							</li>
							<li class="nav-item">
								<a href="{{route('menus.index')}}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Menus</p>
								</a>
							</li>
									
							<li class="nav-item">
								<a href="{{route('categories.index')}}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Category</p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>