<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'item_id', 'buyer_id', 'seller_id'
    ];

    public function toArray() {
        return [
            'id' => $this->id,
            'item_id' => $this->item_id,
            'buyer_id' => $this->buyer_id,
            'seller_id' => $this->seller_id,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at
        ];
    }

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
