<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Briefing;
use App\BriefingSourceType;

class BriefingSource extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'briefing_sources';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'name');
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function briefingSourceType()
    {
    	return $this->belongsTo(BriefingSourceType::class,'briefing_source_type_id');
    }
    
	/**
     * Laravel hasMany relation (BriefingSource-[many]->Briefing).
     * @return object
     */
    public function briefings()
    {
        return $this->hasMany(Briefing::class,'briefing_source_id');
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
