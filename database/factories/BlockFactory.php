<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'district_id' => District::query()->inRandomOrder()->value('id'),
            'name' => $this->faker->sentence,
            'short_name' => $this->faker->sentence,
            
        ];
    }
}
