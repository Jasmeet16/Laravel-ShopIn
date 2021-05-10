<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  //
  protected $guarded = [];

  public function product()
  {
    return $this->hasMany('App\Product');
  }

  public function getCartItems()
  {
    try {
      return Cart::join('products', function ($join) {
        $join->on('carts.product_id', '=', 'products.id')->where('carts.user_id', '=',  Auth::user()->id);
      })->select('*', 'carts.qty as cartquantity')->get();
    } catch (\Exception $e) {
      return view('errors.database', ['error' => $e->getMessage()]);
    }
  }
  public function storeProduct($id)
  {
    Cart::create([
      'user_id' => Auth::user()->id,
      'product_id' => $id,
      'qty' => 1
    ]);
  }

  public function updateQuantity($id, $qty)
  {
    $this->where(['product_id' => $id, 'user_id' => Auth::user()->id])->update(['qty' => $qty]);
  }
  public  function getProductFromCart($id)
  {
    return $this->where(['product_id' => $id, 'user_id' => Auth::user()->id])->get();
  }

  public static function productInCart()
  {
    return Cart::where(  'user_id' , Auth::user()->id)->get();
  }
}
