<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrator Utama',
            'email' => 'admin@edukasi.com',
            'password' => Hash::make('password123'), // Hanya di-hash sekali di sini
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
