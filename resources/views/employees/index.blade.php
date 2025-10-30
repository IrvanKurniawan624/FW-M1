@extends('layouts.master')

@section('title', 'Employees')
    
@section('content')
<div class="d-flex justify-content-between">
    <h2>Table Employee</h2>
    <button type="button" class="btn btn-sm btn-purple"
            data-action="form" 
            data-mode="add" 
            data-resource="employees" 
            data-target="#modal">
        <i class="fa-solid fa-plus me-2"></i>Tambah Data
    </button>
</div>
<table class="table text-center table-striped table-hover table-dark-purple mt-2 datatable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No. Telepon</th>
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
            <td>{{ $employee->alamat }}</td>
            <td>{{ $employee->tanggal_masuk }}</td>
            <td>
                <span class="badge {{ $employee->status == 'nonaktif' ? 'bg-danger' : 'bg-success' }}">
                    {{ $employee->status }}
                </span>
            </td>
            <td>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-shadow-info text-white"
                            data-action="detail" data-resource="employees" data-id="{{ $employee->id }}" data-target="#modalDetail">
                        <i class="fa-solid fa-info me-1"></i> Detail
                    </button>
                    <button type="button" class="btn btn-sm btn-shadow-warning text-white"
                            data-action="form"
                            data-mode="edit"
                            data-resource="employees"
                            data-action-url="{{ url('employees/' . $employee->id) }}"
                            data-id="{{ $employee->id }}">
                        <i class="fa-solid fa-pen me-1"></i>Edit
                    </button>
                    <button class="btn btn-sm btn-shadow-danger text-white"
                            data-action="delete" data-resource="employees" data-id="{{ $employee->id }}">
                        <i class="fa-solid fa-trash me-1"></i>Delete
                    </button>                            
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')    
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('employees.store') }}" class="form_submit" method="post">
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
                        <div class="col-md-6 form-group mb-3">
                            <label for="departmen_id">Departemen</label>
                            <select class="form-control select2" name="departmen_id" id="departmen_id">
                                <option disabled selected value="">Pilih Departemen</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->nama_departmen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="jabatan_id">Jabatan</label>
                            <select class="form-control select2" name="jabatan_id" id="jabatan_id">
                                <option disabled selected value="">Pilih Jabatan</option>
                                @foreach ($positions as $position)
                                    <option class="text-dark" value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                                @endforeach
                            </select>
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
                            <textarea id="alamat" class="form-control" name="alamat" style="min-height: 90px"></textarea>
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


<div class="modal fade" id="modalDetail" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                                <p id="detail_nama_lengkap" data-field="nama_lengkap" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">Email</h6>
                                <p id="detail_email" data-field="email" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">No. Telepon</h6>
                                <p id="detail_nomor_telepon" data-field="nomor_telepon" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">Tanggal Lahir</h6>
                                <p id="detail_tanggal_lahir" data-field="tanggal_lahir" class="mb-0"></p>
                            </div>
                            <div class="col-md-12">
                                <h6 class="fw-bold text-muted">Alamat</h6>
                                <p id="detail_alamat" data-field="alamat" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">Tanggal Masuk</h6>
                                <p id="detail_tanggal_masuk" data-field="tanggal_masuk" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">Departemen</h6>
                                <p id="detail_department" data-field="department.nama_departmen" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">Jabatan</h6>
                                <p id="detail_position" data-field="position.nama_jabatan" class="mb-0"></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted">Status</h6>
                                <p>
                                    <span id="detail_status" data-field="status" class="badge"></span>
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
@endsection
