<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Empleado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empleados = [
            ['id' => 9, 'tipo' => 3, 'empresa_id' => 1, 'hv_cargo_id' => 1, 'foto' => 'foto1.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 10, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 2, 'foto' => 'foto2.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 11, 'tipo' => 3, 'empresa_id' => 1, 'hv_cargo_id' => 2, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 12, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 3, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 13, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 3, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 14, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 3, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 15, 'tipo' => 2, 'empresa_id' => 1, 'hv_cargo_id' => 4, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 16, 'tipo' => 2, 'empresa_id' => 1, 'hv_cargo_id' => 5, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 17, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 5, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 18, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 6, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 19, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 6, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 20, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 6, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 21, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 6, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '0',],
            ['id' => 22, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 7, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 23, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 8, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 24, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 8, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 25, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 8, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 26, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 9, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 27, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 9, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],
            ['id' => 28, 'tipo' => 1, 'empresa_id' => 1, 'hv_cargo_id' => 9, 'foto' => 'usuario-inicial.jpg', 'sexo' => 'Masculino', 'estado' => '1', 'lider' => '1',],


        ];
        foreach ($empleados as $item) {
            DB::table('empleados')->insert([
                'id' => $item['id'],
                'tipo' => $item['tipo'],
                'empresa_id' => $item['empresa_id'],
                'hv_cargo_id' => $item['hv_cargo_id'],
                'foto' => $item['foto'],
                'sexo' => $item['sexo'],
                'estado' => $item['estado'],
                'lider' => $item['lider'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
