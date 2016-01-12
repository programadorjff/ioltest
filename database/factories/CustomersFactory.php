<?php

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'name' => $faker->company,
    	'customer_type_id' => 1
    ];
});
