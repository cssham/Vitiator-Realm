<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Item::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 10),
        'name' => $faker->name,
        'image' => $faker->imageUrl,
        'short_description' => $faker->sentence,
        'long_description' => $faker->paragraph,
        'price' => rand(20, 100),
        'offered_price' => rand(10, 60),
    ];
});
