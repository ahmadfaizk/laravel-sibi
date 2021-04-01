<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = [1, 2];
        foreach ($semesters as $semester) {
            Semester::create(['nama' => $semester]);
        }
    }
}
