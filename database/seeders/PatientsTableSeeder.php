<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'name' => 'John',
                'lastname' => 'Doe',
                'dni' => '12345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane',
                'lastname' => 'Smith',
                'dni' => '111111',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice ',
                'lastname' => 'Johnson',
                'dni' => '2222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Martin ',
                'lastname' => 'Hamon',
                'dni' => '29635178',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test ',
                'lastname' => 'uno',
                'dni' => '2222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
