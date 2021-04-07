<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required'
        ]);

        // dd($request->all());
        //



        $extension = "." . $request->image->getClientOriginalExtension();
        $name = basename($request->image->getClientOriginalName(), $extension) . time();
        $name = $name . $extension;
        echo ($name);

        
        // $path = $request->image->storeAs('uploads',$name);
        Storage::disk('public')->putFileAs('uploads', $request->image , $name);

        $path = '/uploads/' . $name;

        Product::create([
            'name' =>  $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->quantity,
            'image' => $path
        ]);

        // $product = new \App\Product;

        // $product->name =  $request->name;
        // $product->description =  $request->description;

        // $product->price =  $request->price;
        // $product->qty =  $request->quantity;
        // $product->image =  $path;

        // $product->save();





        $request->session('message', "product added successfully");
        // 'email' => 'required|string|email|max:255|unique:users',
        // 'password' => 'required|string|min:6|confirmed',
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = Product::all();
        return view( 'home' , compact('products') );
    }


    public function showsingle($id)
    {
        $product = Product::find($id);
        // dd($product->name);
        return view( 'product' , compact('product') );
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
