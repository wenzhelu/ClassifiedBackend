<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

    protected $fillable = ['description', 'price', 'status', 'purpose', 
        'user_id', 'category', 'photo_url'];

    public function transaction() {
        return $this->hasOne('App\Transaction');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
    
}
