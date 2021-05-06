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
}
