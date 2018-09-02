<?php

namespace App\Http\Controllers;

use App\Lawbreaker;
use Illuminate\Http\Request;

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
        return view('home');
        //return redirect()->back();
    }

}
