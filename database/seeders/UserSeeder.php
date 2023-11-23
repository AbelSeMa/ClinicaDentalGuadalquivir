<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'first_name' => 'Abel',
            'last_name' => 'Sexto',
            'address' => 'Cañada del amarguillo nº 14',
            'phone' => '605123456',
            'birth_date' => '1991-12-05',
            'email' => 'abel.sexto@iesdonana.org',
            'password' => bcrypt('prueba2023')
        ]);

        DB::table('users')->insert([
           'first_name' => 'Antonio',
           'last_name' => 'Recio',
           'address' => 'Calle aguila nº 5',
           'phone' => '956874152',
           'birth_date' => '1974-04-22',
           'email' => 'anto.recio@gmail.com',
           'password' => bcrypt('prueba2023')
       ]);
    }
}
