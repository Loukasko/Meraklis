<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['storeId','name','phone','address','loc_lat','loc_long','chainId','managerId'];
}
