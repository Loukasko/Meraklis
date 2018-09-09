<?php

namespace App\Http\Controllers;

use App\Lawbreaker;
use Illuminate\Http\Request;
use App\Order;
use App\Store;

class LawbreakerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:lawbreaker');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lawbreaker.home');
    }

    public function changeStatus(Request $request){
        $lawbreaker=$request->user('lawbreaker');
        if($lawbreaker->status){
            $lawbreaker->status=0;
            $lawbreaker->save();
        }else{
            $lawbreaker->status=1;
            $lawbreaker->save();
        }
        return redirect()->back();
    }

    public function getLocation(Request $request){
        $lawbreaker=$request->user('lawbreaker');
        $lawbreaker->loc_lat=$request->address;
        $lawbreaker->loc_lat=$request->lat;
        $lawbreaker->loc_long=$request->lng;
        $lawbreaker->save();
    }

    public function showOrders(){
        $orders=Order::all();
        $stores=Store::all();
        $data=array('orders'=>$orders,'stores'=>$stores);
        return view('lawbreaker.showOrders')->with($data);

    }

    public function fetchOrder(Request $request)
    {
        $lawbreaker=$request->user('lawbreaker');
        $max=Order::where('lawbreaker_id',$lawbreaker->id)->max('created_at');
        $order=Order::where('created_at',$max)->first();

        if($order->status==0){
            return redirect()->back()->with('msg','Έχετε αναλάβει ήδη κάποια παραγγελία');
            //return Redirect::back()->withErrors(['msg', 'The Message']);
        }else{
            $min=Order::where('lawbreaker_id',NULL)->min('created_at');
            $order=Order::where('created_at',$min)->first();
            if(empty($order)){
                return redirect()->back()->with('msg','Δεν υπάρχει διαθέσιμη παραγγελία');
            }
            $order->lawbreaker_id=$lawbreaker->id;
            $order->save();
            return redirect()->back();
        }
    }

    public function delivered(Request $request){
        $order=Order::find($request->order_id);
        $order->status=1;
        $order->save();
        return redirect()->back();
    }

}
