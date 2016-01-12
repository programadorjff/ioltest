<?php

$factory->define(App\BriefingOwner::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'name' => $faker->name
    ];
});
