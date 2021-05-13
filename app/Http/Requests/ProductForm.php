<?php

namespace App\Http\Requests;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class ProductForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'categories' => 'required|array|min:1',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'image' => 'required'
        ];
    }

    public function persist()
    {
        
        $extension = "." . $this->image->getClientOriginalExtension();
        $name = basename($this->image->getClientOriginalName(), $extension) . time();
        $name = $name . $extension;

        Storage::disk('public')->putFileAs('uploads', $this->image, $name);

        $path = '/uploads/' . $name;

        $product = Product::create([
            'name' =>  $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'qty' => $this->quantity,
            'image' => $path
        ]);

        $categories = $this->categories;
        $data = [];
        for ($i = 0; $i < count($categories); $i++) {
            if ($categories[$i]) {
                $data[] = array('prod_id' => $product->id, 'catName_id' => $categories[$i]);
            }
        }

        Category::insert($data);


        \Session::flash('message', "Product added successfully");
    }
}
