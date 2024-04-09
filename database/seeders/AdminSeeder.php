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
            'email' => 'mohamedboulkhaima2@gmail.com',
            'password' => bcrypt('mohamed123'),
            'role' => 'admin',
            'is_admin' => true
            
        ]);
    }
}
