<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $citas = [
            ['patient_id' => 1, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '8:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 2, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '8:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 3, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '9:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 4, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '9:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 5, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '10:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 6, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '10:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 7, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '11:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 8, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '11:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 9, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '12:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 10, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '12:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 11, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '13:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 12, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '13:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 13, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '14:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 14, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '14:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 15, 'worker_id' => 1, 'date' => '2023-12-19', 'hour' => '15:00', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
            ['patient_id' => 16, 'worker_id' => 2, 'date' => '2023-12-19', 'hour' => '15:30', 'notes' => 'Lorem ipsun bla bla', 'attended' => true],
        ];

        foreach ($citas as $cita) {
            DB::table('appointments')->insert($cita);
        }
    }
}
