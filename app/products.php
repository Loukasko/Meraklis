<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = ['imagePath', 'title', 'price'];

    public function stores(){
        return $this->belongsToMany('App\Store', 'store_products','id','id')
            ->withPivot('stock');
    }
}
