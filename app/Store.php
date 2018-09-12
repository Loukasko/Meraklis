<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{


    public function products(){
//        return $this->belongsToMany('App\products', 'store_products', 'id','id')
        return $this->belongsToMany('App\products')
            ->withPivot('stock');
    }

    public function manager(){
        return $this->hasOne('App\Manager');
    }
}
