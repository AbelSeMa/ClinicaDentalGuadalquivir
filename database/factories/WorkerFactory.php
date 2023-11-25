<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    protected static $randomUserIds;

    public function definition(): array
    {
        $faker = Faker::create('es_ES');
        
        if (!static::$randomUserIds) {
            static::$randomUserIds = User::all()->pluck('id')->shuffle();
        }

        return [
            'user_id' => static::$randomUserIds->pop(),
            'title' => $this->faker->randomElement(['Dentista', 'Técnico', 'Asistente', 'Cirujano']),
            'specialty' => $this->faker->randomElement(['Ortodoncia', 'Higiene', 'Empastes']),
        ];
    }
}
