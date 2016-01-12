<?php

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'name' => $faker->name,
    	'customer_id' => 1
    ];
});
