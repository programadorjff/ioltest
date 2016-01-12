<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\BriefingSource;

class BriefingSourceType extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'briefing_source_types';

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
     * Laravel hasMany relation (BriefingSourceType-[many]->BriefingSource).
     * @return object
     */
    public function briefingSources()
    {
        return $this->hasMany(BriefingSource::class,'briefing_source_type_id');
    }

    /**
     * Display briefingSource count.
     * @return string
     */
    public function briefingSourceCount()
    {
    	return $this->briefingSources()->count();
    }

}
