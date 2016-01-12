<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Budget;

class BudgetVersion extends Model
{
	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'budget_versions';
	
	protected $dates = ['created_at','updated_at','date_budget_version'];
	
	/**
	 * The fillable property specifies which attributes should be mass-assignable.
	 * @var array
	 */
	protected $fillable = array('user_id', 'last_updated_user_id', 'date_budget_version', 'description');
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function budget()
	{
		return $this->belongsTo(Budget::class);
	}
	
}
