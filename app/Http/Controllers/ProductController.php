<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Response;
use App\Product;

class ProductController extends Controller
{
	
    /**
     * Show us the first 30 products filtered by name
     */
    public function filteredProducts()
    {
    	$filter = Input::get('name');
    	$results = Product::isIol(false)->whereRaw("name LIKE '%$filter%'")->orderBy('name','ASC')->limit(30)->get(['id AS value', 'name AS text']);
    	
    	if ($results->count() > 0)
    		return Response::json(array('results' => $results));
    	else
    		return Response::json(array('results' => '[{}]'));
    }
    
    /**
     * Show us the first 30 products filtered by name
     */
    public function existProduct()
    {
    	$filter = Input::get('name');
    	$result = Product::isIol(false)->where('name',$filter)->limit(1)->get(['id']);
    	return Response::json(array('exist' => ($result->count() > 0)));
    }

}
