<?php

use Illuminate\Database\Seeder;
use App\User;

class CustomerTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        factory(App\CustomerType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
        		'type' => 'Top 10'
        ]);
        factory(App\CustomerType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
        		'type' => 'Top 50'
        ]);
        factory(App\CustomerType::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
        		'type' => 'Top 200'
        ]);
    }
}
