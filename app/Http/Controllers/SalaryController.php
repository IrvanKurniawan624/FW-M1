<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Validation\ValidationException;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::latest()->paginate(5);
        return view('salaries.index', compact('salaries'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'tanggal_gaji' => 'required|date',
                'gaji_pokok' => 'required|numeric',
                'tunjangan' => 'required|numeric',
                'potongan' => 'required|numeric',
                'total_gaji' => 'required|numeric'
            ]);

            $salary = Salary::create($request->all());
            return ApiFormatter::success(200, "Data Berhasil Ditambahkan", $salary);

        } catch (ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        } catch (\Exception $e) {
            return ApiFormatter::error(500, "Terjadi kesalahan", $e->getMessage());
        }
    }

    public function show($id)
    {
        $salary = Salary::find($id);
        if (!$salary) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }
        return ApiFormatter::success(200, "Detail data berhasil diambil", $salary);
    }

    public function edit($id)
    {
        $salary = Salary::find($id);
        if (!$salary) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }
        return ApiFormatter::success(200, "Data berhasil diambil untuk edit", $salary);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'tanggal_gaji' => 'required|date',
                'gaji_pokok' => 'required|numeric',
                'tunjangan' => 'required|numeric',
                'potongan' => 'required|numeric',
                'total_gaji' => 'required|numeric'
            ]);

            $salary = Salary::find($id);
            if (!$salary) {
                return ApiFormatter::error(404, "Data tidak ditemukan");
            }

            $salary->update($request->all());
            return ApiFormatter::success(200, "Data berhasil diperbarui", $salary);
        } catch (ValidationException $e) {
            return ApiFormatter::validate(json_encode($e->errors()));
        }
    }

    public function destroy($id)
    {
        $salary = Salary::find($id);
        if (!$salary) {
            return ApiFormatter::error(404, "Data tidak ditemukan");
        }
        $salary->delete();
        return ApiFormatter::success(200, "Data berhasil dihapus");
    }
}
