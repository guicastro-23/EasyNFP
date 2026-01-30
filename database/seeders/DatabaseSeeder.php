<?php

namespace Database\Seeders;

use App\Models\CstIbsCbs;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            UserSeeder::class,
            CfopSeeder::class,
            CsosnSeeder::class,
            CstIcmsSeeder::class,
            CstPisSeeder::class,
            CstCofinsSeeder::class,
            CstIbsCbsSeeder::class,
    
       ]);
    }
}
