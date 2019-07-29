<?php

use Illuminate\Database\Seeder;

class BarangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Barang::class, 50)->create();
    }
}
