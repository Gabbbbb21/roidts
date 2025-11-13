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
            'user_id' => '0002',
            'name' => 'Mark Doe',
            'division' => 'ESD',
            'role' => 'level 1',
            'username' => 'mdoe',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'user_id' => '0003',
            'name' => 'Do Doe',
            'division' => 'MSD',
            'role' => 'level 1',
            'username' => 'ddoe',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'user_id' => '0004',
            'name' => 'Name Doe',
            'division' => 'PALD',
            'role' => 'level 1',
            'username' => 'ndoe',
            'password' => Hash::make('password'),
        ]);
    }
}
