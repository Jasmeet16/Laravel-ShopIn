<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileForm;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\bg_BG\PhoneNumber;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     ////

     public function getProduct($id)
     {
         try {
             $item = Product::find($id);
         } catch (\Exception $e) {
             return view('errors.database', ['error' => $e->getMessage()]);
         }
         return $item;
     }

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
 
     //
    public function create()
    {

        if (Auth::user()->profile()->get()->isNotEmpty()) {
            $cart = Auth::user()->cart()->get();
            foreach( $cart as $item ){
                $item->product = $this->getProduct( $item->product_id );
            }
            return view('user.checkout' , ['cart' => $cart , 'total' => $this->total()]);
        }
        return view('user.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileForm $form)
    {
        try {
            if (Auth::user()->profile()->get()->isNotEmpty()) {
                return redirect('/checkout');
            }
            $form->persist();
        } catch (\Exception $e) {
            dd($e);
        }
        return redirect('/cart/checkout/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
