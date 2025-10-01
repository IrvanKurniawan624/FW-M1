<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-additional.css') }}">

    @yield('css')

    <title>@yield('title', 'APP PEGAWAI')</title>
</head>

<body>
    <div class="container-fluid d-flex">
        <div class="sidebar bg-light" style="height: 100vh">
            <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px;">
                <a href="/" class="mb-0 link-dark position-absoulte text-decoration-none">
                    <span class="fs-4 text-center d-block">APP - PEGAWAI</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item"><a href="{{ url('/employee') }}" class="nav-link active" aria-current="page">
                        <i class="fa-regular fa-user ms-2"></i>
                            Employee
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/department') }}" class="nav-link link-dark">
                            <i class="fa-regular fa-hospital ms-2"></i>
                            Department
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/attendance') }}" class="nav-link link-dark">
                            <i class="fa-regular fa-id-card ms-2"></i>
                            Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/report') }}" class="nav-link link-dark">
                            <i class="fa-regular fa-file-lines ms-2"></i>
                            Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/settings') }}" class="nav-link link-dark">
                            <i class="fa-solid fa-gear ms-2"></i>
                            Settings
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
    
        <div class="content">
            <div class="m-5">
                @yield('content')
            </div>

            <footer class="bg-light  d-flex align-items-center justify-content-center" style="height: 50px">
                <p class="text-center text-muted m-0">&copy; {{ date('Y') }} App Pegawai</p>
            </footer>
        </div>
    </div>
    
    @yield('modal')


    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    @yield("script")
</body>

</html>
