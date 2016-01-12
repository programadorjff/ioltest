<?php

use Illuminate\Database\Seeder;
use App\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'iol' => false
    	]);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'IOL', 'iol' => true
    	]);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Permanent Line', 'iol' => true
    	]);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Permanent Line Regalo Virtual', 'iol' => true
    	]);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Prime Line', 'iol' => true
    	]);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'New Pack Line', 'iol' => true
    	]);
    	factory(App\Product::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'name' => 'Azafata Trade Line', 'iol' => true
    	]);
    }
}
