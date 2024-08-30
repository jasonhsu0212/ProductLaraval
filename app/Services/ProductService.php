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

     public function filter(string | null $keyword,int $page)
     {
         return $this->productRepository->find($keyword,$page);
     }

    public function getById($id)
    {
         return $this->productRepository->getById($id);
    }

    public function create($request)
    {
        //validate form
        $request->validate([
            'name'         => 'required|string',
            'description'   => 'required|string',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        $this->productRepository->add($request);     
    }

    public function update($request, $id)
    {
        //validate form
        $request->validate([
            'name'         => 'required|string',
            'description'   => 'required|string',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //get product by ID
        $product = $this->productRepository->getById($id);

        $product->name = $request->name;
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

