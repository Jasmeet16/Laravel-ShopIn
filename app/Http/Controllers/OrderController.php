<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
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
        $orders = Order::paginate(10);
        return view('admin.orders' , compact('orders'));
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
             // to show order summary
            $orders =[];

            foreach (Auth::user()->cart()->get() as $item) {
                
                $product = Order::getProduct($item->product_id);
                
                if( $product->qty >=  $item->qty && $item->qty >= 1 ){
                    $orders[] = (new Order)->makeOrder( $item->product_id , $item->qty );
                    $product->qty = $product->qty - $item->qty;
                    $product->save();
                }else{
                    return "invalid request";
                }
            }

            Auth::user()->cart()->delete();

        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
        return view('user.congratulation' , compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        try {
            // $orders = Order::where('user_id', Auth::user()->id)->get();
            $orders = Order::getOrders();
           
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
        return view('user.orders', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function status( $order_id , $status ){
       
        $order = Order::find($order_id);
       
        if($status == 1){
            $newStatus = "Pending";
        }else if( $status == 2 ){
            $newStatus = "Confirmed";
        }else if( $status == 3 ){
            $newStatus = "Dispatched";
        }else if( $status == 4 ){
            $newStatus = "Delivered";
        }
        $order->update(['status' => $newStatus]);
        return $newStatus;
       
    }
}
