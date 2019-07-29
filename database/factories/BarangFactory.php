<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Barang::class, function (Faker\Generator $faker) {
    return [
        'nama' => $faker->name,
        'deskripsi' => $faker->text(),
        'kode' => $faker->swiftBicNumber,
        'stok' => $faker->numberBetween(0, 1000),
        'harga' => $faker->numberBetween(1000, 100000),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
