<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Briefing;
use App\BudgetType;
use App\BudgetVersion;

class Budget extends Model
{
	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'budgets';
	
	protected $dates = ['created_at','updated_at','date_budget'];
	
	/**
	 * The fillable property specifies which attributes should be mass-assignable.
	 * @var array
	 */
	protected $fillable = array('user_id', 'last_updated_user_id', 'briefing_id', 'date_budget', 'budget_type_id', 'total', 'rejected', 'rejected_reason', 'closed');
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function userUpdated()
	{
		return $this->belongsTo(User::class, 'last_updated_user_id');
	}
	
	public function briefing()
	{
		return $this->belongsTo(Briefing::class);
	}
	
	public function budgetType()
	{
		return $this->belongsTo(BudgetType::class,'budget_type_id');
	}
	
	/**
	 * Laravel hasMany relation (Budget-[many]->BudgetVersion).
	 * @return object
	 */
	public function budgetVersions()
	{
		return $this->hasMany(BudgetVersion::class);
	}
	
	/**
	 * Display budgetVersion count.
	 * @return string
	 */
	public function budgetVersionCount()
	{
		return $this->budgetVersions()->count();
	}
	
	// this is a recommended way to declare event handlers
	protected static function boot() {
		parent::boot();
	
		static::deleting(function($budget) { // before delete() method call this
			$budget->budgetVersions()->delete();
		});
	}
	
}
