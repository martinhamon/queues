<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientQueuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_queues')->insert([
            [
                'patient_id' => 1, // Asegúrate de que este ID existe en la tabla patients
                'status' => 'waiting',
                'priority' => 'high',
                'medical_office' => 'Consultorio 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2, // Asegúrate de que este ID existe en la tabla patients
                'status' => 'in progress',
                'priority' => 'medium',
                'medical_office' => 'Consultorio 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 3, // Asegúrate de que este ID existe en la tabla patients
                'status' => 'completed',
                'priority' => 'low',
                'medical_office' => 'Consultorio 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
