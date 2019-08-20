<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 13)->create()->each(function($cat){
            $cat->barangs()->saveMany(factory(App\Barang::class, 10)->make());
        });
    }
}
