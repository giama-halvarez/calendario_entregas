<?php

use Illuminate\Database\Seeder;
use App\SedeEntrega;

class SedesEntregaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sede = new SedeEntrega;
        $sede->nombre = 'Alsina';
        $sede->save();

        $sede = new SedeEntrega;
        $sede->nombre = 'San Juan';
        $sede->save();
    }
}
