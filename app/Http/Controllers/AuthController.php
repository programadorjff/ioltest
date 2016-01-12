<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use View;
use Validator;
use Input;
use Redirect;
use App\User;
use Hash;


class AuthController extends Controller
{

    /**
     * Show the login screen to the user.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return Redirect::to('dashboard');
        }

        return View::make('pages.auth.login');
    }

    /**
     * Logout user and redirect to login screen.
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::to(route('get_login'));
    }

    /**
     * Show signup screen.
     * Redirect to dashboard if a user is signed in.
     */
    public function showSignUp()
    {
        if (Auth::check()) {
            return Redirect::to(route('get_dashboard'));
        }

        return View::make('pages.auth.signup');
    }

    /**
     * Try to sign up a user.
     * Validates email and password fields.
     * On error: redirect back to signup with validator errors.
     * On success: redirect to dashboard with welcome message.
     */
    public function trySignUp()
    {
        $rules = array(
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator->errors())
                ->withInput(Input::except(array('password', 'password_confirm')));
        }

        $user = User::create(array(
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password'))
        ));

        $user->save();

        // Can't Auth::login($user) here because we want the firstTime message.
        $this->tryLogin();

        return Redirect::to(route('get_dashboard'));
    }

    /**
     * Try to log the user in using email and password.
     * On success: redirect to dashboard.
     * On error: redirect to login with error message,
     */
    public function tryLogin()
    {
        $attempt = Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')));

        if (!$attempt) {
            return Redirect::to(route('get_login'))->with('error', trans('auth.errorUserPass'));
        }

        $firstTime = !(Auth::user()->has_signed_in_once);

        Auth::user()->saveSignIn();

        if ($firstTime) {
            return Redirect::intended(route('get_dashboard'));
        }

        return Redirect::intended(route('get_dashboard'));
    }

}
