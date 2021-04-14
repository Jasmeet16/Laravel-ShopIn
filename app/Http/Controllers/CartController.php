<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Cart as AppCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // userid -> cartitems
        // cartitems -> prodid
        // prodid -> prod

        $items = Cart::where( 'user_id' ,Auth::user()->id)->get();
        // dd($items);
        $products = [];
        foreach( $items as $item ){
            $products[] =  Product::where( 'id' , $item->product_id );
        }
        // dd($items);  
        //dd($products);
        return view('user.cart' , compact('products'));
    }

    //custom functions

    public function total(){
        $total = 0;
        $items = Cart::where( 'user_id' ,Auth::user()->id)->get();

        foreach( $items as $item ){
            $product =  Product::where( 'id' , $item->product_id )->get();
            $total += $product[0]->price * $item->qty;
        }
        return $total;
    }
    public function selectedQty($id){
       
        $item = Cart::where( 'product_id' , $id)->get();
    
        return $item[0]->qty;
    }

    public function inCart($id){
       
        $item = Cart::where( [ 'product_id' => $id ,  'user_id' => Auth::user()->id ])->get();
        //dd( $item->isEmpty());
        if( $item->isEmpty()){
            return false;
        }
        return true;
    }
    public function getProduct($id){
        $item = Product::where('id' , $id )->get();
        return $item;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        //dd($request->id);
        try {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
                'qty' => 1
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        
        

        return with('success', 'Product Added To Cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // dd($request->qty);
        Auth::user()->cart->where('product_id' , $id)->update(['qty' => $request->qty ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       /// dd( $request->id );
        $prod = Auth::user()->cart()->where( 'product_id' , $request->id )->get();
        // $items = Cart::where( 'user_id' ,Auth::user()->id )->get();
        //dd($prod);
         Cart::destroy($prod[0]->id);
         return $prod;
    }
}


