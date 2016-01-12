<?php

use Illuminate\Database\Seeder;
use App\User;

class BudgetTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	factory(App\BudgetType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'type' => 'Conferencia telefónica'
    	]);
    	factory(App\BudgetType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'type' => 'Presencial'
    	]);
    	factory(App\BudgetType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'type' => 'Sin definir'
    	]);
    }
}
