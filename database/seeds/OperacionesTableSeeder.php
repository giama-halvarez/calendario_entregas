<?php

use Illuminate\Database\Seeder;
use App\Operacion;

class OperacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Operacion::class,100)->create();
    }
}
