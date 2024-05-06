<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mohamed Bl',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'

        ]);
        User::create([
            'name' => 'Amine Client',
            'email' => 'amin@amin.com',
            'password' => bcrypt('admin123'),
            'role' => 'client'
        ]);
        User::create([
            'name' => 'Reda Mechanic',
            'email' => 'reda@reda.com',
            'password' => bcrypt('admin123'),
            'role' => 'mechanic'
        ]);


    }
}
