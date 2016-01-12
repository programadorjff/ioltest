<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Briefing;

class BriefingOwner extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'briefing_owners';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'name');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    /**
     * Laravel hasMany relation (BriefingOwner-[many]->Briefing).
     * @return object
     */
    public function briefings()
    {
        return $this->hasMany(Briefing::class,'briefing_owner_id');
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
