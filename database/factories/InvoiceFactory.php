<?php

namespace Database\Factories;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition()
    {
        return [
            'additional_charges' => $this->faker->randomFloat(2, 0, 100),
            'total_amount' => $this->faker->randomFloat(2, 100, 1000),
            'repair_id' => function () {
                return Repair::factory()->create()->id;
            },
            'client_id' => function () {
                return User::factory()->create(['role' => 'client'])->id;
            },
        ];
    }

}
