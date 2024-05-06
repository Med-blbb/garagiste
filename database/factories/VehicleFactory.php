<?php

namespace Database\Factories;
use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'make' => $this->faker->word,
            'model' => $this->faker->word,
            'fuel_type' => $this->faker->randomElement(['Gasoline', 'Diesel', 'Electric']),
            'registration' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4}'),
            'images' => null,
            'user_id' => function () {
                return User::where('role', 'client')->inRandomOrder()->first()->id;
            },
        ];
    }
}

