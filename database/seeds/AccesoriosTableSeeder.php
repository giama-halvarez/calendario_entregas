<?php

use Illuminate\Database\Seeder;
use App\Accesorio;

class AccesoriosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $accesorio = new Accesorio;
        $accesorio->nombre = 'Grabado de cristales';
        $accesorio->save();

        $accesorio = new Accesorio;
        $accesorio->nombre = 'Parabrisas';
        $accesorio->save();

        $accesorio = new Accesorio;
        $accesorio->nombre = 'Polarizado';
        $accesorio->save();

        $accesorio = new Accesorio;
        $accesorio->nombre = 'Cerraduras';
        $accesorio->save();
    }
}
