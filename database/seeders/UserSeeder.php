<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        $admin->assignRole('admin');

        $pengguna = User::create([
            'name'=>'pengguna',
            'email'=>'pengguna@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        $pengguna->assignRole('pengguna');

    }
}
