<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SpairPart;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        User::factory(10)->create();

        // Create clients
        Client::factory()->count(10)->create();

        // Create vehicles
        Vehicle::factory()->count(20)->create();

        // Create repairs
        Repair::factory()->count(30)->create();

        // Create spare parts
        SpairPart::factory()->count(50)->create();

        // Create invoices
        Invoice::factory()->count(15)->create();
    }
}
