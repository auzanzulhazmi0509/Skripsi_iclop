<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin2023',
            'email' => 'admin2023@gmail.com',
            'password' => bcrypt('admin2023'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'teacher2023',
            'email' => 'teacher2023@gmail.com',
            'password' => bcrypt('teacher2023'),
            'role' => 'teacher',
        ]);
    }
}
