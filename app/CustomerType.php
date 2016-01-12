<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Customer;
use App\Briefing;

class CustomerType extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'customer_types';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'type', 'value');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    /**
     * Laravel hasMany relation (CustomerType-[many]->Briefing).
     * @return object
     */
    public function briefings()
    {
        return $this->hasMany(Briefing::class,'customer_type_id');
    }

    /**
     * Display briefing count.
     * @return string
     */
    public function briefingCount()
    {
    	return $this->briefings()->count();
    }
    
    public function customers()
    {
    	return $this->hasMany(Customer::class,'customer_type_id');
    }
    
    /**
     * Display customer count.
     * @return string
     */
    public function customerCount()
    {
    	return $this->customers()->count();
    }

}
