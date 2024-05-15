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
            'name' => 'Mohamed Boulkhaima',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'

        ]);
        User::create([
            'name' => 'Zayd Client',
            'email' => 'test@test.com',
            'password' => bcrypt('test123'),
            'role' => 'client'
        ]);
        User::create([
            'name' => 'reda mechanic',
            'email' => 'mechanic@mechanic.com',
            'password' => bcrypt('mechanic123'),
            'role' => 'mechanic'
        ]);


    }
}
