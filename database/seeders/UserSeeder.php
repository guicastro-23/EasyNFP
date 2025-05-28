<?php

namespace Database\Seeders;

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
        User::firstOrCreate(
            ['email'=>'guilherme@example.com'],
            ['name'=> 'Guilherme', 'email' => 'guilherme@example.com',
            'password' => '12345A#']
        );
        User::firstOrCreate(
            ['email'=>'Carlos@example.com'],
            ['name'=> 'carlos', 'email' => 'carlos@example.com',
            'password' => '12345A#']
        );
    }
}
