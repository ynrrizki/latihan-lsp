<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'RPL 1'],
            ['name' => 'RPL 2'],
            ['name' => 'RPL 3'],
            ['name' => 'TKJ 1'],
            ['name' => 'TKJ 2'],
            ['name' => 'TKJ 3'],
            ['name' => 'BC 1'],
            ['name' => 'BC 2'],
            ['name' => 'BC 3'],
            ['name' => 'MM 1'],
            ['name' => 'MM 2'],
            ['name' => 'MM 3'],
            ['name' => 'MM 4'],
            ['name' => 'MM 5'],
        ];

        foreach ($data as $row) {
            Major::create($row);
        }
    }
}
