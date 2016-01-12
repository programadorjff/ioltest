<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Customer;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::find(1);
    	$customer = Customer::find(1);
    	factory(App\Contact::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'customer_id' => $customer->id
    	]);
    }
}
