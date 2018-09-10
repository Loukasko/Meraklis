<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lawbreaker extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','lId','name','surname','AFM','AMKA','IBAN','status','loc_long','loc_lat','chainId','km_today','km_monthly','salary','address','tempDist','ridesToday',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function id(){
        return 'id';
    }

    public function status(){
        return 'status';
    }

    public function address(){
        return 'address';
    }

    public function loc_long(){
        return 'loc_long';
    }
    public function loc_lat(){
        return 'loc_lat';
    }

}
