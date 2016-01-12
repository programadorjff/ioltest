<?php

$factory->define(App\BriefingSource::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
    	'last_updated_user_id' => 1,
    	'name' => $faker->name,
    	'briefing_source_type_id' => 1
    ];
});
