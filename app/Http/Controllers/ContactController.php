<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Response;
use App\Contact;
use DB;

class ContactController extends Controller
{
	
    /**
     * Show us the contacts related with their customer filtered by customerId (cutomerValue)
     */
    public function contactsByCustomer()
    {
    	$filter = Input::get('customerId');
    	$sql = 'SELECT -1 AS value,"' . trans('briefings.contactPH') . '" AS text';
    	$defaultResult = DB::select(DB::raw($sql));
    	$results = Contact::where('customer_id',$filter)->get(['id AS value', 'name AS text'])->toArray();
    	$results = array_merge($defaultResult,$results);
    	return Response::json($results);
    }
    
    /**
     * Show us the contacts filtered by customers and name
     */
    public function existContact()
    {
    	$filterId = Input::get('customerId');
    	$filter = Input::get('name');
    	$filter = ['customer_id' => $filterId, 'name' => $filter];
    	$result = Contact::where($filter)->limit(1)->get(['id']);
    	return Response::json(array('exist' => ($result->count() > 0)));
    }
        
}
