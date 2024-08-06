<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPSTORM_META\type;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complain>
 */
class ComplainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::query()->inRandomOrder()->value('id'),
            'complain_type' => $this->faker->randomElement('type1, type2, typer3'),
            'complain_short_desc' => $this->faker->paragraph,
            'complain_desc' => $this->faker->paragraph,
            'status' => $this->faker->boolean,

        ];
    }
}
