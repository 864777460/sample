<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Status::class, function (Faker $faker) {
	$datetime = time();
    return [
        'content' => $faker->text(),
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
