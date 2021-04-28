<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductForm;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::paginate(10);
        } catch (Exception $e) {
            dd($e);
        }

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
    public function store(ProductForm $form)
    {

        try {
            $form->persist();
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try {
            $products = Product::paginate(6);
        } catch (QueryException $e) {
            return view('errors.database', ['error' => "Error connecting to database"]);
        }
        return view('home', compact('products'));
    }


    public function showsingle($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (QueryException $e) {
            return view('errors.database', ['error' => "Error connecting to database"]);
        } catch (ModelNotFoundException $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }

        return view('product', compact('product'));
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

    public function updateShowForm($id)
    {
        $product = Product::find($id);
        return view('admin.updateProduct', compact('product'));
    }

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id);
       
        

        $path = $product->get()[0]->image;
        if ($request->image) {
            $extension = "." . $request->image->getClientOriginalExtension();
            $name = basename($request->image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension;
            Storage::disk('public')->putFileAs('uploads', $request->image, $name);
            $path = '/uploads/' . $name;
        }

        
        $product->update(['name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'qty' => $request->quantity, 'image' => $path]);
        \Session::flash('message' , "Updated Successfully");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->back();
    }
}
