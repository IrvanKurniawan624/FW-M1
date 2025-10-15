<div class="sidebar bg-light" style="height: 100vh">
    <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px;">
        <a href="/" class="mb-0 link-dark position-absoulte text-decoration-none">
            <span class="fs-4 text-center d-block">APP - PEGAWAI</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            @php
                $url_menu = Request::segment(1);
                // var_dump($url_menu); die;
            @endphp
            <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link @if($url_menu == "dashboard") active @endif" aria-current="page">
                <i class="fa-solid fa-table-cells-large ms-3"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item"><a href="{{ url('/employees') }}" class="nav-link @if($url_menu == "employees") active @endif" aria-current="page">
                <i class="fa-regular fa-user ms-3"></i>
                    Employee
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/departments') }}" class="nav-link @if($url_menu == "departments") active @endif">
                    <i class="fa-regular fa-hospital ms-3"></i>
                    Department
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/attendance') }}" class="nav-link @if($url_menu == "attendance") active @endif">
                    <i class="fa-regular fa-id-card ms-3"></i>
                    Attendance
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/report') }}" class="nav-link @if($url_menu == "report") active @endif">
                    <i class="fa-regular fa-file-lines ms-3"></i>
                    Report
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/settings') }}" class="nav-link @if($url_menu == "settings") active @endif">
                    <i class="fa-solid fa-gear ms-3"></i>
                    Settings
                </a>
            </li>
        </ul>
        <hr>
    </div>
</div>