<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded =[];

    public function updateProduct($name , $description , $price , $quantity , $path){
        $this->update(['name' => $name, 'description' => $description, 'price' => $price, 'qty' => $quantity, 'image' => $path]);
    } 

    public static function getProduct($id){
        return Product::findOrFail($id);
    }

    public static function getFilteredProducts($id){
        return Product::join('categories', function ($join) {
            $join->on('products.id', '=', 'categories.prod_id');
        })->select('*', 'products.id as id')->where('catName_id', $id)->paginate(6);
    }

}
