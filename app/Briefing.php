<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Customer;
use App\CustomerType;
use App\Contact;
use App\Product;
use App\BriefingOwner;
use App\BriefingSource;
use App\Budget;

class Briefing extends Model
{	
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'briefings';
    
    protected $dates = ['created_at','updated_at','date_briefing'];

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'date_briefing', 'customer_id', 'customer_type_id', 'contact_id', 'prod_id', 'iol_prod_id', 'briefing_owner_id', 'briefing_source_id', 'challenge', 'closed');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function userUpdated()
    {
    	return $this->belongsTo(User::class, 'last_updated_user_id');
    }
    
    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
    
    public function customerType()
    {
    	return $this->belongsTo(CustomerType::class,'customer_type_id');
    }
    
    public function contact()
    {
    	return $this->belongsTo(Contact::class);
    }
    
    public function product()
    {
    	return $this->belongsTo(Product::class,'prod_id');
    }
    
    public function iolProduct()
    {
    	return $this->belongsTo(Product::class,'iol_prod_id');
    }
    
    public function briefingOwner()
    {
    	return $this->belongsTo(BriefingOwner::class,'briefing_owner_id');
    }
    
    public function briefingSource()
    {
    	return $this->belongsTo(BriefingSource::class,'briefing_source_id');
    }
    
    /**
     * Laravel hasMany relation (Briefing-[many]->Budget).
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
    
}
