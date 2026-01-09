<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate([
            'name' => 'Administrator',
            'email' => 'admin@ResepMakanan.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'bio' => 'System Administrator',
        ]);
    }
}
