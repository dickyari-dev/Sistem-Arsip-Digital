<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ahmad Subari',
                'email' => 'camat@gmail.com',
                'password' => Hash::make('password'), // ganti dengan password yang aman
                'role' => 'camat',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'pegawai@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dicky Ari Putra',
                'email' => 'dicky@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Nurhalisa',
                'email' => 'siti@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
