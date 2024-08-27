<?php 


namespace App\Services;

use App\Repositories;
use App\Repositories\ProductRepository;
use App\Models\Product;

class ProductService 
{

    protected $productRepository;

     public function __construct(ProductRepository $productRepository)
     {
         $this->productRepository=$productRepository;
     }

     public function lists($size)
     {
         return $this->productRepository->lists($size);
     }

    public function getById($id)
    {
         return $this->productRepository->getById($id);
    }

    public function create($request)
    {
        //validate form
        $request->validate([
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        $this->productRepository->add($request);     
    }

    public function update($request, $id)
    {
        //validate form
        $request->validate([
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //get product by ID
        $product = $this->productRepository->getById($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
      
         //update product 
        $this->productRepository->update($product);
           
    }

    public function delete($id)
    {
        //get product by ID
        $product = $this->productRepository->getById($id);
 
         //delete product
         $product->delete($product);
 
    }
    
}

