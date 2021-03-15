<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_MenuRol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 35; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '1',
                'menu_id' => $i,
            ]);
        }
        for ($i = 1; $i <= 31; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '2',
                'menu_id' => $i,
            ]);
        }
        for ($i = 1; $i <= 35; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '6',
                'menu_id' => $i,
            ]);
        }
    }
}
