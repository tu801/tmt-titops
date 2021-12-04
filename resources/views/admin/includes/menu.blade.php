<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Page</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item menu-open">
          <a href="#" class="nav-link {{ activeClass(Route::is('admin.users.*') || Route::is('admin.roles.*'), 'active') }}">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              User Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.users.list') }}" class="nav-link {{ activeClass(Route::is('admin.users.*'), 'active')}} ">
                <i class="far fa-circle nav-icon"></i>
                <p>List Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.roles.list') }}" class="nav-link {{ activeClass(Route::is('admin.roles.*'), 'active') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
          </ul>
        </li>

        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>