<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('divisions')->insert([
            'division_name' => 'ESD',
        ]);
        FacadesDB::table('divisions')->insert([
            'division_name' => 'MSD',
        ]);
        FacadesDB::table('divisions')->insert([
            'division_name' => 'PALD',
        ]);
        FacadesDB::table('divisions')->insert([
            'division_name' => 'CASHIER',
        ]);
        FacadesDB::table('divisions')->insert([
            'division_name' => 'HRD',
        ]);
    }
}
