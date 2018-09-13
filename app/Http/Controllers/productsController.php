<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use App\cart;
use Session;
use Auth;
use App\Order;

class productsController extends Controller
{
    public function getIndex(){
        //use products model to fetch all the products
        $products = products::all();
        //product is just a var that we will use in our index.blade
        return view('shop.index',['product' => $products]);
    }

    //adding items to the session
    public function  getAddToCart(Request $request, $id){
        $product = products::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('shop.index');
    }

//    public function getCart(){
//        if (!Session::has('cart')){
//            return view('shop.shopping-cart');
//        }
//        $oldCart = Session::get('cart');
//        $cart = new Cart($oldCart);
//        return view('shop.shopping-cart' , ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
//    }

    public function getCart(){

        if (!Session::has('cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

//        $order = new Order();
//        //take php object convert to string and store in DB
//        $order->cart = serialize($cart);
//
//       Session::forget('cart');

        return view('shop.shopping-cart' , ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(Request $request){

        if (!Session::has('cart')) {
            return view('shop.index');
        };

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $order = new Order();
        //take php object convert to string and store in DB
        $order->cart = serialize($cart);
        $order->address = $request->address;
        $order->lat = $request->lat;
        $order->lng = $request->lng;
        $order->status = 0;
        $order->store_id = 1;

        //retrieve user using Auth facade
        Auth::user()->orders()->save($order);

        Session::forget('cart');

    }

}
