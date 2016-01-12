<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Briefing;
use App\Budget;
use Hash;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('email', 'password');

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Laravel hasMany relation (User-[many]->Briefing).
     * @return object
     */
    public function briefings()
    {
        return $this->hasMany(Briefing::class);
    }

    /**
     * Display briefing count.
     * @return string
     */
    public function briefingCount()
    {
    	return $this->briefings()->count();
    }

        /**
     * Laravel hasMany relation (User-[many]->Budget).
     * @return object
     */
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    /**
     * Display budget count.
     * @return string
     */
    public function budgetCount()
    {
    	return $this->budgets()->count();
    }

	/**
     * Set has_signed_in_once to true.
     * Update last_signin.
     */
    public function saveSignIn()
    {
        $this->has_signed_in_once = true;
        $this->last_signin = date('Y-m-d H:i:s');
        $this->save();
    }

    /**
     * Change the email of a User.
     * @param $new_email string The new email.
     * @param $password  string The current password.
     * @return bool True if password matches and no Exceptions.
     */
    public function changeEmail($new_email, $password)
    {
        if (!$this->passwordMatches($password)) {
            return false;
        }

        $this->email = $new_email;
        $this->save();

        return true;
    }

    /**
     * Change the password of a User.
     * @param $new_password string The new password.
     * @param $password     string The current password.
     * @return bool True if password matches and no Exceptions.
     */
    public function changePassword($new_password, $password)
    {
        if (!$this->passwordMatches($password)) {
            return false;
        }

        $this->password = Hash::make($new_password);
        $this->save();

        return true;
    }

    /**
     * Check if given password matches password of User instance.
     * @param $password string Password to check.
     * @return bool
     */
    private function passwordMatches($password)
    {
        if (Hash::check($password, $this->password)) {
            return true;
        }

        return false;
    }
}
