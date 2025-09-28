<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 25; $i++) {
            Employee::create([
                'nama_lengkap' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'nomor_telepon' => $faker->numerify('08##########'),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'alamat' => $faker->address,
                'tanggal_masuk' => $faker->date('Y-m-d', '2025-01-01'),
                'status' => $faker->randomElement(['aktif', 'nonaktif']),
            ]);
        }
    }
}
