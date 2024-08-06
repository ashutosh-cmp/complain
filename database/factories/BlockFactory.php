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
        static $count = 0;
        $data = [
            ['name' => 'Bhatparrani', 'district_id' => 1, 'short_name' => 'brp'],
            ['name' => 'Deoria Sadar', 'district_id' => 1, 'short_name' => 'Deo'],
            ['name' => 'Gola', 'district_id' => 2, 'short_name' => 'Gola'],
            ['name' => 'Gagaha', 'district_id' => 2, 'short_name' => 'Gagaha'],
            ['name' => 'Mall', 'district_id' => 3, 'short_name' => 'Mall'],
            ['name' => 'Malihabad', 'district_id' => 3, 'short_name' => 'Malihabad'],
        ];

        $rowdata = $data[$count];
        $count = ($count + 1) % count($data);

        return $rowdata;
    }
}
