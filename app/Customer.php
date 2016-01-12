<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CustomerType;
use App\Briefing;

class Customer extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'customers';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'name', 'customer_type_id');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function customerType()
    {
    	return $this->belongsTo(CustomerType::class,'customer_type_id');
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

    /**
     * Laravel hasMany relation (Customer-[many]->Contact).
     * @return object
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Display contact count.
     * @return string
     */
    public function contactCount()
    {
    	return $this->contacts()->count();
    }

}
