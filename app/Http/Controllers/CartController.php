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
            //qty defines total items in stock
            // cartquantity defines seleted qty by user 

            $items = Cart::join('products', function ($join) {
                $join->on('carts.product_id', '=', 'products.id')->where('carts.user_id', '=',  Auth::user()->id);
            })->select('*', 'carts.qty as cartquantity')->get();

            $total = 0;

            foreach ($items as $item) {
                $total += $item->price * $item->cartquantity;
            }
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }

        return view('user.cart', ['items' => $items, 'total' => $total]);
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
            $product = $this->getProduct($request->id);
            if ($product->qty >=  $request->qty && $request->qty >= 1) {
                Auth::user()->cart->where('product_id', $request->id)->update(['qty' => $request->qty]);
            } else {
                return response()->json([
                    'updated' => false,
                    'state' => "only " . $product->qty . " items in stock"
                ]);
            }
            return response()->json([
                'updated' => true,
                'state' => $request->qty
            ]);
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
        try {
           
            $items = Cart::join('products', function ($join) {
                $join->on('carts.product_id', '=', 'products.id')->where('carts.user_id', '=',  Auth::user()->id);
            })->select('*', 'carts.qty as cartquantity')->get();

            $total = 0;

            foreach ($items as $item) {
                $total += $item->price * $item->cartquantity;
            }
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }

        return $total;
    }


    public function selectedQty($id)
    {
        $item = Cart::where('product_id', $id)->get();
        return $item[0]->qty;
    }

    

    public function getProduct($id)
    {
        try {
            $item = Product::find($id);
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
        return $item;
    }
}
