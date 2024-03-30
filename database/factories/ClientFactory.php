<?php

namespace Database\Factories;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phoneNumber' => $this->faker->phoneNumber,
            'userID' => User::factory()->create()->id,
        ];
    }
}
