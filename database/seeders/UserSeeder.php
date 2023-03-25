<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
                'username' => 'admin',
                'role' => 'ADMIN',
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@example.com',
                'password' => bcrypt('operator'),
                'username' => 'operator',
                'role' => 'OPERATOR',
            ],
            [
                'name' => 'Student',
                'email' => 'student@example.com',
                'password' => bcrypt('student'),
                'username' => 'student',
                'role' => 'STUDENT',
            ],
        ];

        foreach ($users as $user) {
            $item = User::create($user);
            if ($item->role == 'STUDENT') {
                Student::create([
                    'user_id' => $item->id,
                ]);
            }
        }
    }
}
