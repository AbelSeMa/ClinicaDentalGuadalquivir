<?php

namespace Database\Seeders;

use App\Models\Patient;
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
        $this->call(PlanSeeder::class);
        User::factory(100)->create();
        Worker::factory(25)->create();
        Patient::factory(70)->create();
        $this->call(ServicesSeeder::class);
        $this->call(Services_plansSeeder::class);
        $this->call(AppointmentSeeder::class);

        $admin = new User;
        $admin->first_name = 'Abel';
        $admin->last_name = 'Sexto';
        $admin->dni = '49046135S';
        $admin->email = 'abel@abel.com';
        $admin->birth_date = '1991-12-05';
        $admin->address = 'Calle Real nº 14';
        $admin->phone = '609124980';
        $admin->password = bcrypt('admin');
        $admin->admin = true;

        $admin->save();

    }
}
