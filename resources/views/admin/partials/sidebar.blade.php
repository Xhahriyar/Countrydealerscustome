<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-name">
                    <p class="name">
                        Welcome {{ request()->user()->first_name . ' ' . request()->user()->last_name }}
                    </p>
                    {{-- <p class="designation">
                        {{request()->user()->role}}
                    </p> --}}
                </div>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            @can('dashboard')
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/office/employee/index') ? 'active' : '' }}">
            @can('employee')
                <a class="nav-link" href="{{ route('employee.office.index') }}">
                    <i class="fa-solid fa-user menu-icon"></i>
                    <span class="menu-title">Employees</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/payroll') ? 'active' : '' }}">
            @can('payroll')

            <a class="nav-link" href="{{ route('payroll.index') }}">
                <i class="fa-solid fa-dollar-sign menu-icon"></i>
                <span class="menu-title">Payroll</span>
            </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/client') ? 'active' : '' }}">
            @can('client')
                <a class="nav-link" href="{{ route('client.index') }}">
                    <i class="fa-solid fa-user menu-icon"></i>
                    <span class="menu-title">Client</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/purchase') ? 'active' : '' }}">
            @can('purchase')
                <a class="nav-link" href="{{ route('purchase.index') }}">
                    <i class="fa-solid fa-cart-shopping menu-icon"></i>
                    <span class="menu-title">Purchase</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/expense') ? 'active' : '' }}">
            @can('expense')
                <a class="nav-link" href="{{ route('expense.index') }}">
                    <i class="fa-solid fa-dollar-sign menu-icon"></i>
                    <span class="menu-title">Expense</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/sales/officer') ? 'active' : '' }}">
            @can('sales_officer')
            <a class="nav-link" href="{{ route('sales.officer.index') }}">
                <i class="fa-solid fa-user menu-icon"></i>
                <span class="menu-title">Sales Officer</span>
            </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
            @can('user')
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fa-solid fa-user menu-icon"></i>
                    <span class="menu-title">Users</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('admin/roles') ? 'active' : '' }}">
            @can('role')
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fa-solid fa-user menu-icon"></i>
                    <span class="menu-title">Roles</span>
                </a>
            @endcan
        </li>
        <li class="nav-item {{ Request::is('settings') ? 'active' : '' }}">
            @can('settings')
                <a class="nav-link" href="{{ route('settings') }}">
                    <i class="fa-solid fa-gear menu-icon"></i>
                    <span class="menu-title">Categories</span>
                </a>
            @endcan
        </li>
        {{-- 
                  <li class="nav-item dropdown d-none d-lg-flex">
            <div class="nav-link">
              <span class="dropdown-toggle btn btn-outline-dark" id="languageDropdown" data-toggle="dropdown">English</span>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item font-weight-medium" href="#">
                  Users
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Roles
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Categories
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  Arabic
                </a>
              </div>
            </div>
          </li> --}}
    </ul>
</nav>
