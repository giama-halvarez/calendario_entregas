<?php

use Illuminate\Database\Seeder;
use App\Marca;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $marca = new Marca;
        $marca->nombre = 'Fiat';
        $marca->save();

        $marca = new Marca;
        $marca->nombre = 'Jeep';
        $marca->save();
    }
}
