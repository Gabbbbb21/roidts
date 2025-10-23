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
            'user_id' => '0001',
            'name' => 'John Doe',
            'division' => 'ESD',
            'role' => 'level 1',
            'username' => 'jdoe1',
            'password' => Hash::make('password'),
        ]);
    }
}
