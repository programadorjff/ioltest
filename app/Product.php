<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Briefing;

class Product extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'products';

    /**
     * The fillable property specifies which attributes should be mass-assignable.
     * @var array
     */
    protected $fillable = array('user_id', 'last_updated_user_id', 'name', 'description', 'iol');
    
    /**
     * Scope a query to return iol or not iol products.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsIol($query, $isIol)
    {
    	return $query->where('iol', $isIol);
    }
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
