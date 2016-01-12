<?php

use Illuminate\Database\Seeder;
use App\User;
use App\CustomerType;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	$customer_type = CustomerType::find(1);
    	factory(App\Customer::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'customer_type_id' => $customer_type->id
    	]);
    }
}
