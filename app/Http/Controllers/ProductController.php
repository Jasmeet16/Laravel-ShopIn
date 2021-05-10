<?php

namespace App\Http\Controllers;

use App\Cart;
use Exception;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
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


    ///
    public function inCart()
    {
        $item = Cart::productInCart();
        return $item;
    }
    ///
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
            //getting all the items present in cart against logged in userid
            $cartItems = $this->inCart($product->id);
           
            //getting all the product ids present in cart 
            $cartItemProdId = [];
            foreach ($cartItems as $cartItem) {
                $cartItemProdId[] = $cartItem->product_id;
            }
            
            if (Auth::check()) {
                foreach ($products as $product) {
                    $product->incart = in_array($product->id, $cartItemProdId);
                }
            }
        } catch (QueryException $e) {
            return view('errors.database', ['error' => "Error connecting to database"]);
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
        return view('home', compact('products'));
    }


    public function showsingle($id)
    {
        try {
            $product = Product::getProduct($id);
            if (Auth::check()) {
                $product->incart = $this->inCart($product->id);
            }
        } catch (QueryException $e) {
            return view('errors.database', ['error' => "Error connecting to database"]);
        } catch (ModelNotFoundException $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
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
        $product = Product::getProduct($id);
        return view('admin.updateProduct', compact('product'));
    }

    public function update(Request $request)
    {
        $product = Product::getProduct($request->id);

        $path = $product->get()[0]->image;
        if ($request->image) {
            $extension = "." . $request->image->getClientOriginalExtension();
            $name = basename($request->image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension;
            Storage::disk('public')->putFileAs('uploads', $request->image, $name);
            $path = '/uploads/' . $name;
        }

        $product->updateProduct($request->name, $request->description, $request->price, $request->quantity, $path);


        \Session::flash('message', "Updated Successfully");
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
