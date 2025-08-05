<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Profesional de proyectos - Desarrollador'],
            ['id' => 2, 'nombre' => 'Gerente estratégico'],
            ['id' => 3, 'nombre' => 'Auxiliar administrativo'],
        ]);
    }
}
