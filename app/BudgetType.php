<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Budget;

class BudgetType extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'budget_types';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'type');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    /**
     * Laravel hasMany relation (BudgetType-[many]->Budget).
     * @return object
     */
    public function budgets()
    {
        return $this->hasMany(Budget::class,'budget_type_id');
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
