<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class ProductRepository 
{
    public function getById($id)
    {        
        return Product::findOrFail($id);
    }
    
    public function lists($size)
    {
        return Product::latest()->paginate($size);
    }

    public function add($product)
    {
         //create product
         Product::create([
            'title'         => $product->title,
            'description'   => $product->description,
            'price'         => $product->price,
            'stock'         => $product->stock
        ]);
    }

    public function update($product)
    {
        $product->update();
    }

    public function delete($product)
    {        
         //delete product
         $product->delete();
    }
}