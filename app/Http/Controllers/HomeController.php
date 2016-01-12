<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Redirect;

class HomeController extends Controller
{

    /**
     * Show us the homepage.
     * Or, if someone is logged in, redirect to dashboard.
     */
    public function showHomepage()
    {
        if (Auth::check()) {
            return Redirect::to(route('get_dashboard'));
        }
        return Redirect::to(route('get_login'));
    }

}
