<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use View;
use Validator;
use Input;
use Auth;
use Redirect;

class UserController extends Controller
{

    /**
     * Show us the settings.
     */
    public function showSettings()
    {
        return View::make('pages.user.settings');
    }

    /**
     * Change the email of a user.
     */
    public function changeEmail()
    {
        $rules = array(
            'new_email' => 'required|email|unique:users,email',
            'current_password' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('get_settings'))
                ->withErrors($validator);
        }

        if (!Auth::user()->changeEmail(Input::get('new_email'), Input::get('current_password'))) {
            return Redirect::to(route('get_settings'))
                ->withErrors(array(trans('userSettings.errorCurrentPass')));
        }

        return Redirect::to(route('get_settings'))->with('message', trans('userSettings.emailChanged'));
    }

    /**
     * Change the password of a user.
     */
    public function changePassword()
    {
        $rules = array(
            'new_password' => 'required|min:8|confirmed',
            'current_password' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('get_settings'))
                ->withErrors($validator);
        }

        if (!Auth::user()->changePassword(Input::get('new_password'), Input::get('current_password'))) {
            return Redirect::to(route('get_settings'))
                ->withErrors(array(trans('userSettings.errorCurrentPass')));
        }

        Auth::logout();
        return Redirect::to(route('get_login'))->with('message', trans('userSettings.passChanged'));
    }

    /**
     * [showProfile description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showProfile($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            App::abort(404);
        }

        return View::make('pages.user.profile', array('user' => $user, 'briefingRows' => trans('profile.briefingRows')));
    }

}
