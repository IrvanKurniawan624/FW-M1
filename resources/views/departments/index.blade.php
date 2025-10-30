@extends('layouts.master')

@section('title', 'Departments')
    
@section('content')
<div class="d-flex justify-content-between">
    <h2>Table Department</h2>
    <button type="button" class="btn btn-sm btn-purple"
            data-action="form" 
            data-mode="add" 
            data-resource="departments" 
            data-target="#modal">
        <i class="fa-solid fa-plus me-2"></i>Tambah Data
    </button>
</div>
<table class="table table-center table-striped table-hover table-dark-purple mt-2 datatable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama department</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $key => $department)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $department->nama_departmen }}</td>
            <td>{{ $department->created_at->translatedFormat('d F Y, H:i') }}</td>
            <td>{{ $department->updated_at->translatedFormat('d F Y, H:i') }}</td>
            <td>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-sm btn-shadow-info text-white"
                            data-action="form"
                            data-mode="edit"
                            data-resource="departments"
                            data-id="{{ $department->id }}">
                        <i class="fa-solid fa-pen me-1"></i>Edit
                    </button>
                    <button class="btn btn-sm btn-shadow-danger text-white"
                            data-action="delete" 
                            data-resource="departments" 
                            data-id="{{ $department->id }}">
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
<div class="modal fade" id="modal" tabindex="-1"
    aria-labelledby="modalLabel">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('departments.store') }}" class="form_submit" method="post">
                <input type="text" name="id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label for="nama_departmen">Nama Departmen</label>
                            <input type="text" class="form-control" name="nama_departmen" id="nama_departmen">
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
@endsection