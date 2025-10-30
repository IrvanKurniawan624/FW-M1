<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        $departments = Department::all();
        $positions = Position::all();

        return view('employees.index', [
            'employees' => $employees,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

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
                'departmen_id'   => 'required|exists:departments,id',
                'jabatan_id'     => 'required|exists:positions,id',
            ]);

            $employee = Employee::create($request->all());

            return ApiFormatter::success(200, "Data Berhasil Ditambahkan", $employee);

        } catch (ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        } catch (\Exception $e) {
            return ApiFormatter::error(500, "Terjadi kesalahan", $e->getMessage());
        }
    }

    public function show($id)
    {
        $employee = Employee::with('department', 'position')->find($id);

        if (!$employee) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }

        return ApiFormatter::success(200, "Detail data berhasil diambil", $employee);
    }

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
