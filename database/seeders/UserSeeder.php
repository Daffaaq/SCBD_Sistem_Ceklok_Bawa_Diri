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
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'M. Effendi Cahya, S.E.M.M.',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Kepala Subbagian Umum',
                'role' => 'kasubag',
                'email' => 'kasubag1@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daffa Aqila Rahmatullah, S.Tr.Kom., M.Kom., Ph.D.',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Kepala Subbagian Komputer',
                'role' => 'kasubag',
                'email' => 'kasubag2@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Suprayatno, S.E.',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Staff',
                'role' => 'pegawai',
                'email' => 'pegawai1@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Susanto, S.H.',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Staff',
                'role' => 'pegawai',
                'email' => 'pegawai2@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rini Lestari, S.Psi.',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Staff',
                'role' => 'pegawai',
                'email' => 'pegawai3@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bayu Aji, S.Kom.',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Staff',
                'role' => 'pegawai',
                'email' => 'pegawai4@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dika Bagaskara',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Satpam',
                'role' => 'pegawai',
                'email' => 'pegawai5@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Musthofa',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Satpam',
                'role' => 'pegawai',
                'email' => 'pegawai6@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'M. Yussuf Hamka',
                'no_telp' => rand(1000000000, 9999999999),
                'jabatan' => 'Satpam',
                'role' => 'pegawai',
                'email' => 'pegawai7@gmail.com',
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
