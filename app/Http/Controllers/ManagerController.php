<?php

namespace App\Http\Controllers;

use App\Manager;
use Illuminate\Http\Request;
use App\products;
use App\cart;
use Session;
use Auth;
use App\Store;
use App\Order;
use DB;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:manager');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.home');
    }

    public function resupply(){

       $products = Auth::user('manager')->store->products;
       $i = 0;
        foreach($products as $product){
            $new[$i] = ['title' => $product->title, 'stock'=> $product->pivot->stock];
            $i++;
        }

        $new = collect($new);
        return view('manager.resupply',['products' => $new]);
    }

    public function postUpdate(Request $request){

        $store = Auth::user('manager')->store->id;

        for($i = 0; $i < 5; $i++){
            if( $request->input('data')[$i] != NULL ){
                    $match_these = ['products_id' => $i+6, 'store_id' => $store];
                    DB::table('products_store')->where($match_these)->update(array('stock' => $request->input('data')[$i]));
            }
        }

        return view('manager.home');
    }

    public function orders(){
        return view('manager.manager_orders');
    }

    public function ajax_orders(){
        $store_id = Auth::user('manager')->store->id;
        $match_there = ['store_id' => $store_id, 'status' => 0];
        $orders = Order::where($match_there)->get();
        $orders->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });


//        foreach($orders as $order){
//            $order->cart = unserialize($order->cart);
//        }

        return \Response::json($orders);

    }

}
