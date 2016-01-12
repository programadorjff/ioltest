<?php

$factory->define(App\Briefing::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'date_briefing' => $faker->date($format = 'Y-m-d', $max = 'now'),
    	'customer_id' => 1,
    	'customer_type_id' => 1,
    	'prod_id' => 2,
    	'iol_prod_id' => 1,
    	'briefing_owner_id' => 1,
    	'briefing_source_id' => 1,
    	'challenge' => $faker->randomElement($array = array ('true','false')),
    	'closed' => true,
    ];
});
