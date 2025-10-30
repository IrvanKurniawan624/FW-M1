<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(5);
        return view('departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_departmen' => 'required|string|max:255',
            ]);

            $department = Department::create($request->all());
            return ApiFormatter::success(200, "Data Berhasil Ditambahkan", $department);

        } catch (ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        } catch (\Exception $e) {
            return ApiFormatter::error(500, "Terjadi kesalahan", $e->getMessage());
        }
    }

    public function show($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }
        return ApiFormatter::success(200, "Detail data berhasil diambil", $department);
    }

    public function edit($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }
        return ApiFormatter::success(200, "Data berhasil diambil untuk edit", $department);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_departmen' => 'required|string|max:255',
            ]);

            $department = Department::find($id);
            if (!$department) {
                return ApiFormatter::error(404, "Data tidak ditemukan");
            }

            $department->update($request->all());
            return ApiFormatter::success(200, "Data berhasil diperbarui", $department);
        } catch (ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        }
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }
        $department->delete();
        return ApiFormatter::success(200, "Data berhasil dihapus");
    }
}
