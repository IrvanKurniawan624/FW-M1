<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'tanggal_gaji',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
