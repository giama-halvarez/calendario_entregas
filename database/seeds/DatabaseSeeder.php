<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MarcasTableSeeder::class);
        $this->call(SedesEntregaTableSeeder::class);
        $this->call(OperacionesTableSeeder::class);
        $this->call(AccesoriosTableSeeder::class);
        $this->call(OperacionesAccesoriosTableSeeder::class);
    }
}
