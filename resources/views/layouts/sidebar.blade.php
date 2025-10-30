<div class="sidebar bg-white shadow-sm app-sidebar" style="min-height: 100vh; width: 280px;">
    <div class="d-flex flex-column flex-shrink-0 p-3">
        <div class="logo-container text-center mb-4">
            <img src="{{ asset('icons/logo.png') }}" alt="Logo" class="logo-img mb-2" style="height: 60px;">
            <h5 class="mb-0 fw-bold text-purple">APP PEGAWAI</h5>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto gap-1">
            @php
                $url_menu = Request::segment(1);
            @endphp
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ $url_menu == 'dashboard' ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.index') }}" class="nav-link {{ $url_menu == 'employees' ? 'active' : '' }}">
                    <i class="fa-solid fa-users me-2"></i>
                    Employees
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('departments.index') }}" class="nav-link {{ $url_menu == 'departments' ? 'active' : '' }}">
                    <i class="fa-solid fa-building me-2"></i>
                    Departments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('positions.index') }}" class="nav-link {{ $url_menu == 'positions' ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-simple me-2"></i>
                    Jabatan
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('/icons/avatar.png') }}" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
            </ul>
        </div>
    </div>
</div>