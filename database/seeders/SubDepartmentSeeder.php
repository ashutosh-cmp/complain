<?php

namespace Database\Seeders;

use App\Models\SubDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubDepartment::factory()->count(101)->create();
    }
}