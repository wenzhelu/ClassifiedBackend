<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function buyer() {
        return $this->belongsTo('App\User', 'buyer_id');
    }

    public function seller() {
        return $this->belongsTo('App\User', 'seller_id');
    }
}
