<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class PatientFactory extends Factory
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
            'plan_id' => $this->faker->randomElement([1, 2, 3]),
            'medical_history' => $this->faker->paragraph(),
            'payment_date' => null,
            'expiration_date' => null
        ];
    }
}
