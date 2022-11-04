<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $password = Hash::make('toptal');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => $password,
            'role' => 2
        ]);

        User::create([
            'name' => 'normal user',
            'email' => 'user@gmail.com',
            'password' => $password,
            'role' => 1
        ]);
    }
}
