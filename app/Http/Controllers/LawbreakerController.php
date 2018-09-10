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

    private $temp;

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
            $lawbreaker->km_monthly+=$lawbreaker->km_today;
            $lawbreaker->ridesToday=0;
            $lawbreaker->km_today=0;
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
//        $lawbreaker=$request->user('lawbreaker');
//        $max=Order::where('lawbreaker_id',$lawbreaker->id)->max('created_at');
//        $min=Order::where('lawbreaker_id',NULL)->min('created_at');
//
//        $order=Order::where('created_at',$max)->first();
//
//        if($order->status==0){
//            return redirect()->back()->with('msg','Έχετε αναλάβει ήδη κάποια παραγγελία');
//            //return Redirect::back()->withErrors(['msg', 'The Message']);
//        }else if(!empty($min)){
//            $order=Order::where('created_at',$min)->first();
//            if(empty($order)){
//                return redirect()->back()->with('msg','Δεν υπάρχει διαθέσιμη παραγγελία');
//            }
//            $order->lawbreaker_id=$lawbreaker->id;
//            $order->save();
//            return redirect()->back();
//        }

        $lawbreaker=$request->user('lawbreaker');
        $max=Order::where('lawbreaker_id',$lawbreaker->id)->where('status','0')->max('created_at');
        $min=Order::where('lawbreaker_id',NULL)->where('status','0')->min('created_at');

        if(!empty($max)){
            return redirect()->back()->with('msg','Έχετε αναλάβει ήδη κάποια παραγγελία');
        }if(!empty($min)){
            $order=Order::where('created_at',$min)->first();
            $order->lawbreaker_id=$lawbreaker->id;
            $order->save();
            return redirect()->back();
        }else{
            return redirect()->back()->with('msg','Δεν υπάρχει διαθέσιμη παραγγελία');
        }

    }

    public function delivered(Request $request){
        $lawbreaker=$request->user('lawbreaker');
        $order=Order::find($request->order_id);

        $lawbreaker->loc_lat=$order->lat;
        $lawbreaker->loc_long=$order->lng;
        $lawbreaker->km_today+=$lawbreaker->tempDist;
        $order->status=1;
        $lawbreaker->ridesToday++;

        $lawbreaker->save();
        $order->save();

        return redirect()->back();
    }

    public function getDistance(Request $request){

        $lawbreaker=$request->user('lawbreaker');
        $lawbreaker->tempDist=$request->dist/10;

        $lawbreaker->save();
    }

    public function getStats(Request $request){
        return view('lawbreaker.stats');

    }

}
