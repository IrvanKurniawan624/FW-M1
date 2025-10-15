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
        @include('layouts.sidebar')
    
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
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $('.modal').on('show.bs.modal', function () {
            let form = $(this).find('form')[0];
            if (form) {
                form.reset(); 
            }

            $(this).find('.is-invalid').removeClass('is-invalid');
            $(this).find('.invalid-feedback').remove();
        });
    </script>

    @yield("script")
</body>

</html>
