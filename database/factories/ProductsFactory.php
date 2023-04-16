<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'admin_id' => 1,
        'title' => $faker->name,
        'price' => $faker->randomFloat(2, 0, 100),
        'description' => $faker->text(100),
        'image' => $faker->imageUrl(640, 480),
        'discount' => $faker->randomFloat(2, 0, 100),
        'type' => 1,
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
