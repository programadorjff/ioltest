<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Customer;
use App\Contact;
use App\Product;
use App\BriefingOwner;
use App\BriefingSource;

class BriefingsTableSeeder extends Seeder
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
    	$contact = Contact::find(1);
    	$prod = Product::find(1);
    	$iol_prod = Product::find(2);
    	$briefing_owner = BriefingOwner::find(1);
    	$briefing_source = BriefingSource::find(1);
    	factory(App\Briefing::class)->create(['user_id' => $user->id, 'last_updated_user_id' => $user->id,
    			'customer_id' => $customer->id, 'customer_type_id' => $customer->customer_type_id,
    			'contact_id' => $contact->id,
    			'prod_id' => $prod->id, 'iol_prod_id' => $iol_prod->id,
    			'briefing_owner_id' => $briefing_owner->id, 'briefing_source_id' => $briefing_source->id
    	]);
    	
    }
}
