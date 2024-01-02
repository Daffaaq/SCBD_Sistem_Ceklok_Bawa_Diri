<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Superadmin User',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Superadmin Job Title',
                'role' => 'superadmin',
                'email' => 'superadmin@gmaul.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasubag User',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Kasubag Job Title',
                'role' => 'kasubag',
                'email' => 'kasubag@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pegawai User',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Pegawai Job Title',
                'role' => 'pegawai',
                'email' => 'pegawai@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ];

        foreach ($users as $userData) {
            DB::table('users')->insert($userData);
        }
    }
}
