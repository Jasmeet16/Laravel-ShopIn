<?php

namespace App\Http\Controllers;

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


    public function create()
    {
        try {
            if (Auth::user()->profile()->get()->isNotEmpty()) {


                if( Auth::user()->cart == null ){
                    return view('errors.database', ['error' =>"No Items present in Cart"]);
                } 
                $carts =  Auth::user()->cart->getCartItems();


                $total = 0;
                foreach ($carts as $item) {
                    $total += $item->price * $item->cartquantity;
                }


                return view('user.checkout', ['cart' => $carts, 'total' => $total]);
            }
            return view('user.profile');
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
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
            return view('errors.database', ['error' => $e->getMessage()]);
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
