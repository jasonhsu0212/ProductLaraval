<?php 


namespace App\Services;

use App\Repositories;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Response;

class ProductService 
{

    protected $productRepository;

     public function __construct(ProductRepository $productRepository)
     {
         $this->productRepository=$productRepository;
     }

     public function filter(string | null $keyword,int $page,int $pre_page)
     {        
         $products = $this->productRepository->find($keyword,$page,$pre_page);
         
         return $products;
        // return response(ProductResource::collection($products), Response::HTTP_OK);
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
        
        return true; 
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
           
        return response()->json(['message' => 'Product update','code'=>1], 200);
    }

    public function delete($id)
    {
        //get product by ID
        $product = $this->productRepository->getById($id);
 
         //delete product
         $product->delete($product);
 
         return response()->json(['message' => 'Product delete','code'=>1], 200);
    }
    
}

