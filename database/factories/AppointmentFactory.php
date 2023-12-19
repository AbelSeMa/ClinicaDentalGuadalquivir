<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected static $randomPatientIds;
    protected static $randomWorkerIds;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = Faker::create('es_ES');
        if (!static::$randomPatientIds) {
            $randomPatientIds = Patient::all()->pluck('id')->shuffle();
        }
        if (!static::$randomWorkerIds) {
            $randomWorkerIds = Worker::all()->pluck('id')->shuffle();
        }


        return [
            'patient_id' => $randomPatientIds->pop(),
            'worker_id' => $randomWorkerIds->pop(),
            'date' => $faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear())->format('Y-m-d'),
            'hour' => $faker->dateTimeBetween('09:00', '16:00')->format('H:i'),
            'notes' => $faker->text,
            'attended' => $faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
