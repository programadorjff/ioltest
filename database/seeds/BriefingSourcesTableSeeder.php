<?php

use Illuminate\Database\Seeder;
use App\User;
use App\BriefingSourceType;

class BriefingSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	$briefing_source_type1 = BriefingSourceType::find(1);
    	$briefing_source_type2 = BriefingSourceType::find(2);
    	$briefing_source_type3 = BriefingSourceType::find(3);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Ruth', 'briefing_source_type_id' => $briefing_source_type1->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Sara', 'briefing_source_type_id' => $briefing_source_type1->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Arianna', 'briefing_source_type_id' => $briefing_source_type1->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Patricia', 'briefing_source_type_id' => $briefing_source_type2->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Giovanna', 'briefing_source_type_id' => $briefing_source_type2->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Cliente', 'briefing_source_type_id' => $briefing_source_type3->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Mailing', 'briefing_source_type_id' => $briefing_source_type3->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Espontáneo', 'briefing_source_type_id' => $briefing_source_type3->id
    	]);
    	factory(App\BriefingSource::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Web', 'briefing_source_type_id' => $briefing_source_type3->id
    	]);
    }
}
