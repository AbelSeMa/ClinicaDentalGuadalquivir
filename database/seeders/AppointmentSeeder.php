<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $citas = [];

        for ($i = 0; $i < 100; $i++) {
            $inicio = Carbon::createFromDate(2020, 1, 1);
            $fin = Carbon::createFromDate(2024, 12, 31);
            $dias = $inicio->diffInDays($fin);
            $fecha = $inicio->addDays(rand(0, $dias)); // Entre 0 y 731 días después del 1 de enero de 2023
            
            $attended = $fecha->isPast() ? (bool) rand(0, 1) : false; // Si la fecha es pasada, el estado es false
            $worker_id = rand(1, 20); // Generar worker_id aleatorio entre 1 y 20
            $patient_id = rand(1, 20);

            $citas[] = [
                'patient_id' => $patient_id,
                'worker_id' => $worker_id,
                'date' => $fecha,
                'hour' => rand(8, 15) . ':00', // Hora aleatoria entre las 8:00 y las 15:00
                'notes' => 'Lorem ipsum bla bla',
                'attended' => $attended,
            ];
        }

        foreach ($citas as $cita) {
            DB::table('appointments')->insert($cita);
        }
    }
}
