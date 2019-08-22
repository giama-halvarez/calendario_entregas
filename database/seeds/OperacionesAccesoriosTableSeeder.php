<?php

use Illuminate\Database\Seeder;
use App\OperacionAccesorio;

class OperacionesAccesoriosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(OperacionAccesorio::class,250)->create();
    }
}
