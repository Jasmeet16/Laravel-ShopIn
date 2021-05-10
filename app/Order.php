<?php

namespace App;

use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public static function getProduct($id)
    {
        return Product::find($id);
    }

    public function makeOrder($product_id, $qty)
    {
        return Order::create([
            'user_id' =>  Auth::user()->id,
            'product_id' => $product_id,
            'qty' => $qty
        ]);
    }

    public static function getOrders()
    {
        return Order::join('products', function ($join) {
            $join->on('orders.product_id', '=', 'products.id')->where('orders.user_id', Auth::user()->id);
        })->select('*', 'orders.qty as orderqty')->get();
    }

    public static function getUsersOrders($user_id){
        try {
            $userOrders = Order::where('user_id' , $user_id);
            return $userOrders->join( 'products' , function($join){
               $join->on( 'orders.product_id' , '=' , 'products.id' );
           } )->select('*' , 'orders.qty as orderqty')->get();
            
        } catch (\Exception $e) {
            return view('errors.database', ['error' => $e->getMessage()]);
        }
    }
}
