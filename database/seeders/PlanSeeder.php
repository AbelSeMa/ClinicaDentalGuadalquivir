<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan1 = new Plan;

        $plan1->name = 'Básico';
        $plan1->price = 199.90;
        $plan1->duration_in_months = 12;
        
        $plan1->save();

        $plan2 = new Plan;
        $plan2->name = 'Brillante';
        $plan2->price = 450;
        $plan2->duration_in_months = 12;
        
        $plan2->save();

        $plan3 = new Plan;
        $plan3->name = 'Oro';
        $plan3->price = 625.99;
        $plan3->duration_in_months = 12;
        
        $plan3->save();
    }
}
