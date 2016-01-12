<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Auth;
use View;
use Validator;
use Redirect;
use Input;
use App\Briefing;
use App\Customer;
use App\CustomerType;
use App\Contact;
use App\Product;
use App\BriefingSource;
use App\BriefingOwner;

class BriefingController extends Controller
{

	private function loadBriefingsData($briefingId) {
		$isAdding = true;
		$briefings = Briefing::orderBy('date_briefing','DESC')->orderBy('created_at','DESC')->orderBy('customer_type_id','ASC')->get();
		$customers = Customer::orderBy('name','ASC')->limit(30)->get();
		$customerTypes = CustomerType::orderBy('id','ASC')->get();
		$products = Product::isIol(false)->orderBy('name','ASC')->limit(30)->get();
		$iolProducts = Product::isIol(true)->orderBy('name','ASC')->get();
		$briefingSources = BriefingSource::orderBy('briefing_source_type_id','ASC')->orderBy('name','ASC')->get();
		$briefingOwners = BriefingOwner::orderBy('name','ASC')->get();
		
		$addEditTitleLabel = trans('briefings.add');
		 
		$relationships = array('customers' => $customers,
				'customerTypes' => $customerTypes,
				'products' => $products,
				'iolProducts' => $iolProducts,
				'briefingSources' => $briefingSources,
				'briefingOwners' => $briefingOwners
		);
		
		if (isset($briefingId)) {
			$isAdding = false;
			$addEditTitleLabel = trans('briefings.edit');
			$briefingToEdit = Briefing::find($briefingId);
			
			if (!$briefingToEdit)
				return Redirect::to(route('get_briefings'));
			else
				return View::make('pages.briefings.index')->with('isAdding', $isAdding)->with('addEditTitleLabel', $addEditTitleLabel)->with('briefings', $briefings)->with('relationships', $relationships)->with('briefingToEdit', $briefingToEdit);
		} else {
			return View::make('pages.briefings.index')->with('isAdding', $isAdding)->with('addEditTitleLabel', $addEditTitleLabel)->with('briefings', $briefings)->with('relationships', $relationships);
		}
	}
	
    /**
     * Show us all the briefings of the App
     */
    public function showBriefings()
    {
		return $this->loadBriefingsData(null);
    }

    /**
     * Add/Update a briefing for the current user.
     */
    public function addUpdateBriefing()
    {
    	
    	$not_in_usual = "-1,0";
    	$not_in_exceptional = "-1/-1,0/0";
    	
        $rules = array(
            'dateBriefing' => 'required|date',
            'customer' => 'required|not_in:'.$not_in_exceptional,
            'customerType' => 'required|not_in:'.$not_in_usual,
        	'contact' => 'required|not_in:'.$not_in_usual,
        	'product' => 'required|not_in:'.$not_in_usual,
        	'iolProduct' => 'required|not_in:'.$not_in_usual,
        	'briefingSource' => 'required|not_in:'.$not_in_usual,
        	'briefingOwner' => 'required|not_in:'.$not_in_usual,
        	'challenge' => 'boolean',
        	'closed' => 'boolean'
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            return Redirect::to(route('get_briefings'))
                ->withErrors($validator->errors())
                ->withInput(Input::all());
        }
        
        $messageSuccesful = trans('briefings.recAdded');
        
        $briefingId = Input::get('idRec');
        $dateBriefing = Input::get('dateBriefing');
        $customer = Input::get('customer');
        $customerType = Input::get('customerType');
        $contact = Input::get('contact');
        $product = Input::get('product');
        $iolProduct = Input::get('iolProduct');
        $briefingSource = Input::get('briefingSource');
        $briefingOwner = Input::get('briefingOwner');
        $challenge = Input::get('challenge');
        $closed = 0;
        
        if($challenge == null)
        	$challenge = 0;
        
        $user = Auth::user();
        $auxCustomer = explode('/',$customer);
        $customer = $auxCustomer[0];
        if (!is_numeric($customer)) {
        	$auxCustomer = explode('|',$customer);
        	$newCustomer = new Customer();
        	$newCustomer->user_id = $user->id;
        	$newCustomer->last_updated_user_id = $user->id;
        	$newCustomer->name = $auxCustomer[1];
        	$newCustomer->customer_type_id = $customerType;
        	$newCustomer->save();
        	$customer = $newCustomer->id;
        }
        
        if (!is_numeric($contact)) {
        	$auxContact = explode('|',$contact);
        	$newContact = new Contact();
        	$newContact->user_id = $user->id;
        	$newContact->last_updated_user_id = $user->id;
        	$newContact->name = $auxContact[1];
        	$newContact->customer_id = $customer;
        	$newContact->save();
        	$contact = $newContact->id;
        }
        
        if (!is_numeric($product)) {
        	$auxProduct = explode('|',$product);
        	$newProduct = new Product();
        	$newProduct->user_id = $user->id;
        	$newProduct->last_updated_user_id = $user->id;
        	$newProduct->name = $auxProduct[1];
        	$newProduct->iol = 0;
        	$newProduct->save();
        	$product = $newProduct->id;
        }
        
        $briefing = new Briefing();
        $briefing->user_id = $user->id;
        if ($briefingId !== '*') {
        	$briefing = Briefing::find($briefingId);
        	$messageSuccesful = trans('briefings.recEdited');
        }
        $briefing->last_updated_user_id = $user->id;
        $briefing->date_briefing = $dateBriefing;
        $briefing->customer_id = $customer;
        $briefing->customer_type_id = $customerType;
        $briefing->contact_id = $contact;
        $briefing->prod_id = $product;
        $briefing->iol_prod_id = $iolProduct;
        $briefing->briefing_source_id = $briefingSource;
        $briefing->briefing_owner_id = $briefingOwner;
        $briefing->challenge = $challenge;
        $briefing->closed = $closed;
        
        $briefing->save();
        
        return Redirect::to(route('get_briefings'))->with('message', $messageSuccesful);
    }

    /**
     * Delete a briefing
     */
    public function deleteBriefing()
    {
        $briefing = Briefing::find(Input::get('id'));

        if (!$briefing) {
            return Redirect::to(route('get_briefings'));
        }
        
        if ($briefing->budgetCount() > 0)
        	return Redirect::to(route('get_briefings'))->withErrors(trans('validation.briefings.linkedBudgets'));

        $briefing->delete();

        return Redirect::to(route('get_briefings'))->with('message', trans('briefings.recDeleted'));
    }
    
    /**
     * Load data to edit a briefing
     */
    public function loadToEditBriefing()
    {
		return $this->loadBriefingsData(Input::get('idRecToEdit'));
    }

}
