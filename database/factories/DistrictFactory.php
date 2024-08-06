<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $district = [
            'Deoria' => 'Deo',
            'Gorakhpur' => 'Gkp',
            'Lucknow' => 'Lko'
        ];

        static $index = 0;
        $keys = array_keys($district);
        $name = $keys[$index];
        $short_name = $district[$name];

        $index = ($index + 1) % count($keys);

        return [
            'state_id' => '1',
            'name' => $name,
            'short_name' => $short_name,
        ];
    }

}
