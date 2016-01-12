<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;
use Auth;
use Redirect;

class DashboardController extends Controller
{

    /**
     * Show us the dashboard.
     */
    public function showDashboard()
    {
    	if (Auth::check()) {
    		return View::make('pages.dashboard');
    	}
    	return Redirect::to(route('get_login'));
    }

}
