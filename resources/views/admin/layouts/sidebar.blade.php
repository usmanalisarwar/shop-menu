<div class="sidebar">
	<!-- Sidebar user (optional) -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard')  }}" class="nav-link @if(isset($active) && $active == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @php
                $menus = getSideBar();
                @endphp
                @foreach($menus as $menu)
                    <li class="nav-item">
                        <a href="{{ url($menu->url)  }}" class="nav-link @if(isset($active) && $active == $menu->active) active @endif">
							<i class="nav-icon fas fa-{{ $menu->icon }}"></i>
                            <p>{{ $menu->name }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
