<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Page</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->


    <!-- Heading -->


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        URI
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @yield('rooms.active')">
        <a class="nav-link collapsed" href="{{ route('rooms.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>{{__('messages.rooms.rooms')}}</span></a>
        </a>

    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item @yield('room-types.active')">
        <a class="nav-link" href="{{ route('room-types.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>{{__('messages.room_types.room_types')}}</span></a>
    </li>

    <!-- Nav Item - Tables -->


    <li class="nav-item @yield('services.active')">
        <a class="nav-link" href="{{ route('services.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>{{__('messages.services.services')}}</span></a>
    </li>

    <li class="nav-item @yield('townships.active')">
        <a class="nav-link" href="{{ route('townships.index') }}">
            <i class="fas fa-fw fa-city"></i>
            <span>{{__('messages.townships.townships')}}</span></a>
    </li>

    <li class="nav-item @yield('bookings.active')">
        <a class="nav-link" href="{{ route('bookings.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>{{__('messages.bookings.bookings')}}</span></a>
    </li>

    <li class="nav-item @yield('customers.active')">
        <a class="nav-link" href="{{ route('customers.index') }}">
            <i class="fas fa-smile"></i>
            <span>{{__('messages.customers.customers')}}</span></a>
    </li>

    <li class="nav-item @yield('users.active')">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-user"></i>
            <span>{{__('messages.users.users')}}</span></a>
    </li>

    @hasrole('Admin')
    <li class="nav-item @yield('roles.active')">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-user"></i>
            <span>{{__('messages.roles.roles')}}</span></a>
    </li>
    @endhasrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
