<?php

use Illuminate\Database\Seeder;
use App\User;

class BriefingOwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	factory(App\BriefingOwner::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Ruth'
    	]);
    	factory(App\BriefingOwner::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Sara'
    	]);
    	factory(App\BriefingOwner::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Arianna'
    	]);
    	factory(App\BriefingOwner::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Laura'
    	]);
    }
}
