<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Worker;
use Carbon\Carbon;
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

        $date = $faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear())->format('Y-m-d');
        $hour = $this->faker->numberBetween(8, 15) . ':' . $this->faker->randomElement(['00', '30']);

        // Establecer el estado de la cita
        $today = Carbon::today();
        $status = $date <= $today ? $faker->randomElement(['Presentado', 'No presentado']) : 'Pendiente';

        return [
            'patient_id' => $randomPatientIds->pop(),
            'worker_id' => $randomWorkerIds->pop(),
            'date' => $date,
            'hour' => $hour, // Hora ajustada
            'notes' => $this->faker->text,
            'status' => $status,
        ];
    }
}
