<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            ['id' => 1, 'nombre' => 'Administración'],
            ['id' => 2, 'nombre' => 'Operaciones'],
            ['id' => 3, 'nombre' => 'Recursos Humanos'],
        ]);
    }
}
