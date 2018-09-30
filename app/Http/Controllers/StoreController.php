<?php

namespace App\Http\Controllers;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function return_stores(){
        $store = Store::all();
        return \Response::json($store);
    }
}
