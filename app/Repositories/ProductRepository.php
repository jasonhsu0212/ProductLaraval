<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
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
    protected $query;
    public function getById($id)
    {        
        return Product::findOrFail($id);
    }
    
    public function find($keyword,$page)
    {
        $this->query = Product::query();
        if($keyword){
            $this->query->where(function($query) use ($keyword){
                $query->where('name','like','%'.$keyword.'%');
                $query->orWhere('description','like','%'.$keyword.'%');
            });
        }
        return $this->query->orderBy('id','asc')->paginate($page);
    }

    public function add($product)
    {
        try{
            //create product
            // Product::create([
            //     'name'         => $product->name,
            //     'description'   => $product->description,
            //     'price'         => $product->price,
            //     'stock'         => $product->stock
            // ]); 
        Product::create($product->all());
        }
            catch(Exception $e){
                return $e;
            }
        
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