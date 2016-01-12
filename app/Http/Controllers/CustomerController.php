<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Response;
use App\Customer;

class CustomerController extends Controller
{
	
    /**
     * Show us the first 30 customers filtered by name
     */
    public function filteredCustomers()
    {
    	$filter = Input::get('name');
    	$results = Customer::selectRaw("CONCAT(id,',',customer_type_id) AS value, name AS text")->whereRaw("name LIKE '%$filter%'")->orderBy('name','ASC')->limit(30)->get();
    	
    	if ($results->count() > 0) {
    		return Response::json(array('results' => $results));
    	}
    	else {
    		return Response::json(array('results' => '[{}]'));
    	}
    }
    
    /**
     * Show us the first 30 customers filtered by name
     */
    public function existCustomer()
    {
    	$filter = Input::get('name');
    	$result = Customer::where('name',$filter)->limit(1)->get(['id']);
    	return Response::json(array('exist' => ($result->count() > 0)));
    }
    
}
