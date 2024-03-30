<?php

namespace Database\Factories;
use App\Models\SpairPart;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpairPartFactory extends Factory
{
    protected $model = SpairPart::class;

    public function definition()
    {
        return [
            'part_name' => $this->faker->word,
            'part_reference' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'supplier' => $this->faker->company,
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
