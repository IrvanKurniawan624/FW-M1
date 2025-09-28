<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(5);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap'   => 'required|string|max:255',
                'email'          => 'required|email|max:255',
                'nomor_telepon'  => 'required|string|max:20',
                'tanggal_lahir'  => 'required|date',
                'alamat'         => 'required|string|max:255',
                'tanggal_masuk'  => 'required|date',
                'status'         => 'required|string|max:50',
            ]);

            $employee = Employee::create($request->all());

            return ApiFormatter::success(200, "Data Berhasil Ditambahkan", $employee);

        } catch (ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        } catch (\Exception $e) {
            return ApiFormatter::error(500, "Terjadi kesalahan", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }

        return ApiFormatter::success(200, "Detail data berhasil diambil", $employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }

        return ApiFormatter::success(200, "Data berhasil diambil untuk edit", $employee);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_lengkap'   => 'required|string|max:255',
                'email'          => 'required|email|max:255|unique:employees,email,' . $id,
                'nomor_telepon'  => 'required|string|max:20',
                'tanggal_lahir'  => 'required|date',
                'alamat'         => 'required|string|max:255',
                'tanggal_masuk'  => 'required|date',
                'status'         => 'required|string|max:50',
            ]);

            $employee = Employee::find($id);

            if (!$employee) {
                return ApiFormatter::error(404, "Data tidak ditemukan");
            }

            $employee->update($request->all());

            return ApiFormatter::success(200, "Data berhasil diperbarui", $employee);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }

        $employee->delete();

        return ApiFormatter::success(200, "Data berhasil dihapus");
    }

}
