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

    <title>Employee</title>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h2>Table Employee</h2>
            <button type="button" class="btn btn-sm btn-purple text-white btn-form"
                    data-mode="add" data-action="{{ route('employees.store') }}">
                <i class="fa-solid fa-plus me-2"></i>Tambah Data
            </button>
        </div>
        <table class="table text-center table-striped table-hover table-dark-purple mt-2">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $key => $employee)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->nomor_telepon }}</td>
                    <td>{{ $employee->tanggal_lahir }}</td>
                    <td>{{ $employee->alamat }}</td>
                    <td>{{ $employee->tanggal_masuk }}</td>

                    <td>
                        <span class="badge {{ $employee->status == 'nonaktif' ? 'bg-danger' : 'bg-success' }}">
                            {{ $employee->status }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-shadow-info text-white btn-detail" data-id="{{ $employee->id }}">
                                <i class="fa-solid fa-info me-1"></i> Detail
                            </button>
                            <button type="button" class="btn btn-sm btn-shadow-warning text-white btn-form"
                                    data-mode="edit"
                                    data-action="{{ url('employees/' . $employee->id) }}"
                                    data-id="{{ $employee->id }}">
                                <i class="fa-solid fa-pen me-1"></i>Edit
                            </button>
                            <button class="btn btn-sm btn-shadow-danger text-white btn-delete" data-id="{{ $employee->id }}"><i class="fa-solid fa-trash me-1"></i>Delete</button>                            
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalLabel">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route("employees.store") }}" class="form_submit" method="post">
                    <input type="text" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="text" class="form-control" name="nomor_telepon">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk">
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label class="d-block mb-2">Status</label>
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusAktif" value="aktif" checked>
                                    <label class="form-check-label" for="statusAktif">Aktif</label>
                                </div>
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="nonaktif">
                                    <label class="form-check-label" for="statusNonaktif">Nonaktif</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="alamat">Alamat</label>                       
                                <textarea name="alamat" class="form-control" name="alamat" style="min-height: 90px"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="button_submit">
                            <span class="indicator-label">Simpan</span>
                            <div class="loading-button">
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DETAIL MODAL -->
    <div class="modal fade" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDetailLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg rounded-3 border-0">
                <div class="modal-header bg-dark-purple text-white">
                    <h5 class="modal-title" id="modalDetailLabel">
                        <i class="fa-solid fa-user me-2"></i> Detail Employee
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">Nama Lengkap</h6>
                                    <p id="detail_nama_lengkap" class="mb-0"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">Email</h6>
                                    <p id="detail_email" class="mb-0"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">No. Telepon</h6>
                                    <p id="detail_nomor_telepon" class="mb-0"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">Tanggal Lahir</h6>
                                    <p id="detail_tanggal_lahir" class="mb-0"></p>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="fw-bold text-muted">Alamat</h6>
                                    <p id="detail_alamat" class="mb-0"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">Tanggal Masuk</h6>
                                    <p id="detail_tanggal_masuk" class="mb-0"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">Status</h6>
                                    <p>
                                        <span id="detail_status" class="badge"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        $('.form_submit').on('submit', function(e) {
            e.preventDefault(); 
            let this_form = this;

            Swal.fire({
                title: 'Yakin?',
                text: 'Apakah anda yakin ingin menyimpan data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Tidak!',
            }).then((result) => {
                if (result.value) {
                    $("#button_submit").attr('status', "loading").attr('disabled', true);
                    $("#modal_loading").modal('show');

                    $.ajax({
                        url: $(this_form).attr('action'),
                        type: $(this_form).attr('method'),
                        data: $(this_form).serialize(),
                        success: function(response) {
                            setTimeout(() => { $('#modal_loading').modal('hide'); }, 500);
                            $("#button_submit").removeAttr('status').removeAttr('disabled');

                            if (response.code == 200) {
                                Swal.fire('Berhasil!', response.message, 'success').then(() => {
                                    $(".modal").modal('hide');
                                    this_form.reset();
                                    location.reload();
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            setTimeout(() => { $('#modal_loading').modal('hide'); }, 500);
                            $("#button_submit").removeAttr('status').removeAttr('disabled');

                            if (jqXHR.status == 400) { 
                                $('.invalid-feedback').remove();
                                $('input, textarea, select').removeClass('is-invalid');

                                let errors = jqXHR.responseJSON.errors;
                                Object.keys(errors).forEach(function(key) {
                                    let elem = $(this_form).find('[name="' + key + '"]');
                                    let messages = errors[key]; 
                                    messages.forEach(function(message) {
                                        let errorMessage = `<span class="d-flex text-danger invalid-feedback">${message}</span>`;
                                        if (elem.parent().hasClass('input-group')) {
                                            elem.parent().children("input:last-child").addClass('is-invalid');
                                            elem.parent().append(errorMessage);
                                        } else {
                                            elem.addClass('is-invalid');
                                            elem.after(errorMessage);
                                        }
                                    });
                                });

                                Swal.fire('Oops!', jqXHR.responseJSON.message, 'warning');
                            } else if (jqXHR.status == 500) {
                                Swal.fire('Error!', jqXHR.responseJSON.message, 'error');
                            } else {
                                Swal.fire('Oops!', 'Something wrong, try again later (' + errorThrown + ')', 'error');
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".btn-detail", function () {
            let id = $(this).data("id");

            $.ajax({
                url: "/employees/" + id,
                type: "GET",
                success: function (response) {
                    if (response.code == 200) {
                        let emp = response.data;

                        $("#detail_nama_lengkap").text(emp.nama_lengkap);
                        $("#detail_email").text(emp.email);
                        $("#detail_nomor_telepon").text(emp.nomor_telepon);
                        $("#detail_tanggal_lahir").text(emp.tanggal_lahir);
                        $("#detail_alamat").text(emp.alamat);
                        $("#detail_tanggal_masuk").text(emp.tanggal_masuk);

                        if (emp.status === "aktif") {
                            $("#detail_status").text("Aktif").removeClass().addClass("badge bg-success");
                        } else {
                            $("#detail_status").text("Nonaktif").removeClass().addClass("badge bg-danger");
                        }

                        $("#modalDetail").modal("show");
                    }
                },
                error: function () {
                    Swal.fire("Oops!", "Gagal mengambil data detail", "error");
                },
            });
        });


        $(document).on("click", ".btn-form", function () {
            let mode   = $(this).data("mode");
            let action = $(this).data("action");
            let id     = $(this).data("id");
            let modal  = $("#modal");
            let form   = modal.find("form");

            form.attr("action", action).find('input[name="_method"]').remove();

            $("#modalLabel").text(mode === "add" ? "Tambah Employee" : "Edit Employee");

            if (mode === "edit") {
                form.append('<input type="hidden" name="_method" value="PUT">');

                $.get(`/employees/${id}`, function (res) {
                    if (res.code === 200) {
                        let e = res.data;
                        form.find('[name="id"]').val(e.id);
                        form.find('[name="nama_lengkap"]').val(e.nama_lengkap);
                        form.find('[name="email"]').val(e.email);
                        form.find('[name="nomor_telepon"]').val(e.nomor_telepon);
                        form.find('[name="tanggal_lahir"]').val(e.tanggal_lahir);
                        form.find('[name="tanggal_masuk"]').val(e.tanggal_masuk);
                        form.find('[name="alamat"]').val(e.alamat);
                        form.find(`[name="status"][value="${e.status}"]`).prop("checked", true);
                    }
                }).fail(() => Swal.fire("Oops!", "Gagal mengambil data employee", "error"));
            }

            modal.modal("show");
        });



        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Yakin?',
                text: 'Data ini akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/employees/' + id, 
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function (response) {
                            if (response.code == 200) {
                                Swal.fire('Berhasil!', response.message, 'success')
                                    .then(() => location.reload());
                            }
                        },
                        error: function () {
                            Swal.fire('Oops!', 'Gagal menghapus data', 'error');
                        }
                    });
                }
            });
        });


    </script>
</body>

</html>
