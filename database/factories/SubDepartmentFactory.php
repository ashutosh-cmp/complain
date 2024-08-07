<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubDepartment>
 */
class SubDepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'department_id' => Department::query()->inRandomOrder()->value('id'),
            'status' => $this->faker->boolean,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'created_by'=> User::query()->inRandomOrder()->value('id'),
        ];
    }
}