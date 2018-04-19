<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

    protected $fillable = ['description', 'price', 'status', 'purpose', 
        'user_id', 'category', 'photo_url', 'name'];

    public function transaction() {
        return $this->hasOne('App\Transaction');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    // 
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'user' => $this->user()->get(),
            'category' => $this->category,
            'purpose' => $this->purpose,
            'photo_url' => $this->photo_url,
            'status' => $this->status,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
    
}
