<?php

namespace Database\Seeders;

use App\Models\StdClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StdClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'XII', 'major_id' => 1],
            ['name' => 'XII', 'major_id' => 2],
            ['name' => 'XII', 'major_id' => 3],
            ['name' => 'XII', 'major_id' => 4],
            ['name' => 'XII', 'major_id' => 5],
            ['name' => 'XII', 'major_id' => 6],
            ['name' => 'XII', 'major_id' => 7],
            ['name' => 'XII', 'major_id' => 8],
            ['name' => 'XII', 'major_id' => 9],
            ['name' => 'XII', 'major_id' => 10],
            ['name' => 'XII', 'major_id' => 11],
            ['name' => 'XII', 'major_id' => 12],
            ['name' => 'XII', 'major_id' => 13],
            ['name' => 'XII', 'major_id' => 14],
            ['name' => 'XI', 'major_id' => 1],
            ['name' => 'XI', 'major_id' => 2],
            ['name' => 'XI', 'major_id' => 3],
            ['name' => 'XI', 'major_id' => 4],
            ['name' => 'XI', 'major_id' => 5],
            ['name' => 'XI', 'major_id' => 6],
            ['name' => 'XI', 'major_id' => 7],
            ['name' => 'XI', 'major_id' => 8],
            ['name' => 'XI', 'major_id' => 9],
            ['name' => 'XI', 'major_id' => 10],
            ['name' => 'XI', 'major_id' => 11],
            ['name' => 'XI', 'major_id' => 12],
            ['name' => 'XI', 'major_id' => 13],
            ['name' => 'XI', 'major_id' => 14],
            ['name' => 'X', 'major_id' => 1],
            ['name' => 'X', 'major_id' => 2],
            ['name' => 'X', 'major_id' => 3],
            ['name' => 'X', 'major_id' => 4],
            ['name' => 'X', 'major_id' => 5],
            ['name' => 'X', 'major_id' => 6],
            ['name' => 'X', 'major_id' => 7],
            ['name' => 'X', 'major_id' => 8],
            ['name' => 'X', 'major_id' => 9],
            ['name' => 'X', 'major_id' => 10],
            ['name' => 'X', 'major_id' => 11],
            ['name' => 'X', 'major_id' => 12],
            ['name' => 'X', 'major_id' => 13],
            ['name' => 'X', 'major_id' => 14],
        ];
        foreach ($data as $row) {
            StdClass::create($row);
        }
    }
}
