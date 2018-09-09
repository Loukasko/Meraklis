<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo('app\User');
    }

    protected $fillable = [
        'id', 'lat','lng','status','address','store_id','user_id','created_at','updated_at','cart','lawbreaker_id'

    ];

}
