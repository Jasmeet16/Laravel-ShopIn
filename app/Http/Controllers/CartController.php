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
        try {
            $items = Cart::where('user_id', Auth::user()->id)->get();
            $products = [];
            foreach ($items as $item) {
                $products[] =  Product::where('id', $item->product_id);
            }
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }

        return view('user.cart', compact('products'));
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
    public function store(Request $request)
    {
        try {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
                'qty' => 1
            ]);
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
        return redirect('/cart');
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
    public function update(Request $request)
    {
        try {
            Auth::user()->cart->where('product_id', $request->id)->update(['qty' => $request->qty]);
            return redirect()->back();
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $prod = Auth::user()->cart()->where('product_id', $request->id)->get();
            Cart::destroy($prod[0]->id);
            return $prod;
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
    }

    //custom functions

    public function total()
    {
        $total = 0;
        $items = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($items as $item) {
            $product =  Product::where('id', $item->product_id)->get();
            $total += $product[0]->price * $item->qty;
        }
        return $total;
    }

    public function selectedQty($id)
    {
        $item = Cart::where('product_id', $id)->get();
        return $item[0]->qty;
    }

    public function inCart($id)
    {
        $item = Cart::where(['product_id' => $id,  'user_id' => Auth::user()->id])->get();
        if ($item->isEmpty()) {
            return false;
        }
        return true;
    }

    public function getProduct($id)
    {
        $item = Product::where('id', $id)->get();
        return $item;
    }
}
