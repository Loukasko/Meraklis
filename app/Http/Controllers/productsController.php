<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\products;
use App\cart;
use Mockery\Undefined;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Order;
use DB;
class productsController extends Controller
{
    public function getIndex(){
        //use products model to fetch all the products
        if(Auth::guest()){
            return redirect()->back()->withErrors(['msg' => 'You have to be signed in to access this page']);
        }else {
            $products = products::all();
            //product is just a var that we will use in our index.blade
            return view('shop.index', ['product' => $products]);
        }
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
    public function getEmptyCart(Request $request){
        if (!Session::has('cart')){
            return view('shop.shopping-cart');
        }
        Session::forget('cart');
        return redirect()->route('shop.index');
    }

    public function getCart(){
        if(Auth::guest()){
            return redirect()->back()->withErrors(['msg' => 'You have to be signed in to access this page']);
        } else {
            if (!Session::has('cart')) {
                return view('shop.shopping-cart');
            }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }
    }
    public function getCheckout(Request $request){
        if (!Session::has('cart')) {
            return view('shop.index');
        };
        $user=$request->user();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $order = new Order();
        //take php object convert to string and store in DB
        $order->cart = serialize($cart);
        $order->address = $request->address;
        $order->lat = $request->lat;
        $order->lng = $request->lng;
        $order->status = 0;
        $order->store_id=$user->csid;
        $store = $user->csid;

        //retrieve user using Auth facade
        Auth::user()->orders()->save($order);

        //reduce stock
        for( $i = 6; $i <= 10; $i++){
            if( !empty ($cart->items[$i]) ){
                $match_these = ['products_id' => $i, 'store_id' => $store];
                for(  $j = 0; $j < $cart->items[$i]['qty']; $j++){
                    if ( (DB::table('products_store')->select('stock')->where($match_these)->value('stock')) !== 0 ) {

                        DB::table('products_store')->where($match_these)->decrement('stock', 1);
                    }
                }
            }
        }

        Session::forget('cart');
        //$request->session()->forget('cart');
    }
}
