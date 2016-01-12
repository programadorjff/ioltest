<?php

use Illuminate\Database\Seeder;
use App\User;

class BriefingSourceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	factory(App\BriefingSourceType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'type' => 'Conceptualización'
    	]);
    	factory(App\BriefingSourceType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'type' => 'Prospección'
    	]);
    	factory(App\BriefingSourceType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'type' => 'Otros'
    	]);
    }
}
