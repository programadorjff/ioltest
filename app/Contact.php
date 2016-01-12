<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Customer;
use App\Briefing;

class Contact extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'name', 'customer_id');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function customer()
    {
    	return $this->belongsTo(Customer::class,'customer_type_id');
    }

    /**
     * Laravel hasMany relation (Customer-[many]->Briefing).
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

}
