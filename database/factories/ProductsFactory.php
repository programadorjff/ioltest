<?php

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'name' => str_random(25),
    	'iol' => $faker->randomElement($array = array ('true','false'))
    ];
});
