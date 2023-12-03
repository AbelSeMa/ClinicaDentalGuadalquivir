<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Service;
use App\Models\User;
use App\Models\Worker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        Worker::factory(25)->create();
        Patient::factory(70)->create();
        Appointment::factory(300)->create();
        $this->call(PlanSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(Services_plansSeeder::class);
    }
}
