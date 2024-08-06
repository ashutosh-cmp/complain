<?php

namespace Database\Seeders;

use App\Models\Complain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complain::factory()->count(201)->create();
    }
}