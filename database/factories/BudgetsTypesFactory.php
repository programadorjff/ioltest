<?php

$factory->define(App\BudgetType::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'type' => $faker->word
    ];
});
