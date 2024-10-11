<div class="sidebar">
	<!-- Sidebar user (optional) -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

			<li class="nav-item">
				<a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
					<i class="nav-icon fas fa-home"></i> <!-- Changed icon to "fa-home" -->
					<p>Dashboard</p>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
					<i class="nav-icon fas fa-user-shield"></i> <!-- Changed icon to "fa-user-shield" -->
					<p>Roles</p>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
					<i class="nav-icon fas fa-list-alt"></i> <!-- Changed icon to "fa-list-alt" -->
					<p>Category</p>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{ route('menus.index') }}" class="nav-link {{ request()->routeIs('menus.index') ? 'active' : '' }}">
					<i class="nav-icon fas fa-bars"></i> <!-- Changed icon to "fa-bars" -->
					<p>Menus</p>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{ route('menu-items.index') }}" class="nav-link {{ request()->routeIs('menu-items.index') ? 'active' : '' }}">
					<i class="nav-icon fas fa-utensils"></i> <!-- Changed icon to "fa-utensils" -->
					<p>Menu Items</p>
				</a>
			</li>
		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
