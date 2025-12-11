<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin user
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@vedkalp.com'],
            [
                'name' => 'Super',
                'password' => bcrypt('Welcome@2025'),
            ]
        );
    }
}