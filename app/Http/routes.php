<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
 */

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	Route::get('/', 'HomeController@showHomepage');
	
	Route::get('login', array('as' => 'get_login', 'uses' => 'AuthController@showLogin'));
	Route::get('logout', array('as' => 'get_logout', 'uses' => 'AuthController@logout'));
	Route::get('signup', array('as' => 'get_signup', 'uses' => 'AuthController@showSignUp'));
	
	Route::group(array('before' => 'csrf'), function () {
	    Route::post('login', array('as' => 'post_login', 'uses' => 'AuthController@tryLogin'));
	    Route::post('signup', array('as' => 'post_signup', 'uses' => 'AuthController@trySignUp'));
	});
	
	/*
	|--------------------------------------------------------------------------
	| All routes in this group require a signed in user
	|--------------------------------------------------------------------------
	 */
	Route::group(array('before' => 'auth'), function () {
	    Route::get('dashboard', array('as' => 'get_dashboard', 'uses' => 'DashboardController@showDashboard'));
	    Route::get('profile/{id}', array('as' => 'show_profile', 'uses' => 'UserController@showProfile'));
	    Route::get('user/settings', array('as' => 'get_settings', 'uses' => 'UserController@showSettings'));
	    Route::get('briefings', array('as' => 'get_briefings', 'uses' => 'BriefingController@showBriefings'));
	    Route::get('budgets', array('as' => 'get_budgets', 'uses' => 'BudgetController@showBudgets'));
	
	    Route::group(array('before' => 'csrf'), function () {
	    	Route::post('budgets', array('as' => 'post_budgets', 'uses' => 'BudgetController@showBudgets'));
	        Route::post('user/settings/email', array('as' => 'change_email', 'uses' => 'UserController@changeEmail'));
	        Route::post('user/settings/password', array('as' => 'change_password', 'uses' => 'UserController@changePassword'));
	        Route::post('briefings/add', array('as' => 'add_update_briefing', 'uses' => 'BriefingController@addUpdateBriefing'));
	        Route::post('briefings/load', array('as' => 'load_edit_briefing', 'uses' => 'BriefingController@loadToEditBriefing'));
	        Route::post('briefings/delete', array('as' => 'delete_briefing', 'uses' => 'BriefingController@deleteBriefing'));
	        Route::post('budgets/add', array('as' => 'add_update_budget', 'uses' => 'BudgetController@addUpdateBudget'));
	        Route::post('budgets/load', array('as' => 'load_edit_budget', 'uses' => 'BudgetController@loadToEditBudget'));
	        Route::post('budgets/delete', array('as' => 'delete_budget', 'uses' => 'BudgetController@deleteBudget'));
	        Route::post('customers/filtered', array('as' => 'get_filtered_customers', 'uses' => 'CustomerController@filteredCustomers'));
	        Route::post('customers/exist', array('as' => 'exist_customer', 'uses' => 'CustomerController@existCustomer'));
	        Route::post('contacts/contactsByCustomer', array('as' => 'contacts_by_customer', 'uses' => 'ContactController@contactsByCustomer'));
	        Route::post('contacts/exist', array('as' => 'exist_contact', 'uses' => 'ContactController@existContact'));
	        Route::post('products/filtered', array('as' => 'get_filtered_products', 'uses' => 'ProductController@filteredProducts'));
	        Route::post('products/exist', array('as' => 'exist_product', 'uses' => 'ProductController@existProduct'));
	    });
	});
});
