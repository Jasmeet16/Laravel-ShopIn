<?php

namespace App\Http\Controllers;

use App\Order;
use App\Profile;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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
        if(  Auth::user()->profile()->get()->isNotEmpty() ){
            return view('user.checkout');
        } 
        return view('user.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {

     
    if(  Auth::user()->profile()->get()->isNotEmpty() ){
        return redirect('/checkout');
    }

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        $completeAddress = $request->address . $request->state .$request->zip;

        Profile::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $completeAddress,
        ]);
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
