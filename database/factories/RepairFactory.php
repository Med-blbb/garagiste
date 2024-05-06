<?php

namespace Database\Factories;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
    protected $model = Repair::class;

    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'mechanic_notes' => $this->faker->paragraph,
            'client_notes' => $this->faker->paragraph,
            'mechanic_id' => function () {
                return User::factory()->create(['role' => 'mechanic'])->id;
            },
            'vehicle_id' => function () {
                return Vehicle::factory()->create()->id;
            },
            
        ];
    }
}
