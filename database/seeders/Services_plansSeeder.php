<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Services_plansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviciosPlanes = [
            ['plan_id' => 1, 'service_id' => 1],
            ['plan_id' => 2, 'service_id' => 2],
            ['plan_id' => 3, 'service_id' => 3],
            ['plan_id' => 1, 'service_id' => 4],
            ['plan_id' => 2, 'service_id' => 4],
            ['plan_id' => 3, 'service_id' => 4],
            ['plan_id' => 1, 'service_id' => 5],
            ['plan_id' => 2, 'service_id' => 5],
            ['plan_id' => 2, 'service_id' => 6],
            ['plan_id' => 3, 'service_id' => 5],
            ['plan_id' => 3, 'service_id' => 6],
            ['plan_id' => 3, 'service_id' => 7],
            ['plan_id' => 1, 'service_id' => 8],
            ['plan_id' => 2, 'service_id' => 9],
            ['plan_id' => 3, 'service_id' => 10],
            ['plan_id' => 1, 'service_id' => 11],
            ['plan_id' => 2, 'service_id' => 11],
            ['plan_id' => 2, 'service_id' => 12],
            ['plan_id' => 3, 'service_id' => 11],
            ['plan_id' => 3, 'service_id' => 12],
            ['plan_id' => 3, 'service_id' => 13],
            ['plan_id' => 2, 'service_id' => 14],
            ['plan_id' => 3, 'service_id' => 15],
            ['plan_id' => 1, 'service_id' => 16],
            ['plan_id' => 2, 'service_id' => 16],
            ['plan_id' => 3, 'service_id' => 16],
            ['plan_id' => 1, 'service_id' => 17],
            ['plan_id' => 2, 'service_id' => 17],
            ['plan_id' => 3, 'service_id' => 17]       
        ];

        foreach ($serviciosPlanes as $servicio) {
            DB::table('plan_service')->insert($servicio);
        }
    }
}