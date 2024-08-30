<?php

namespace App\Http\Controllers;

//import model product

use App\Services\ProductService;
use Illuminate\Routing\Controller;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseField;
use App\Http\Requests\ProductListRequest;
use App\Http\Requests\ProductBaseRequest;

/**
 * @group Product
 *
 *  產品管理
 */
class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * @group Product
     *
     * 查詢產品
     */
    public function index(ProductListRequest $productRequest)
    {
        //get all products
        $keyword = $productRequest->input('keyword', null);
        $page = $productRequest->input('page', null);
        //render view with products
        //return view('products.index', compact('products'));
        return $this->productService->filter($keyword, $page);
    }



    /**
     * @group Product
     *
     * 新增產品
     */
    public function add(ProductBaseRequest $request)
    {
        //get product by ID
        $products = $this->productService->create($request);
        //redirect to index

        return response()->json(['status' => 0, 'posts' =>  $products]);
        //return response()->json(['status' => 0, 'posts' =>  $products]);
    }

    /**
     * @group Product
     *
     * 查詢單一產品
     */
    #[QueryParam('id', 'int', '員工ID')]
    #[ResponseField('status', 'int', '狀態')]
    public function show(string $id)
    {
        //get product by ID
        $product = $this->productService->getById($id);

        //render view with product
        //return view('products.show', compact('product'));
        return response()->json(['status' => 0, 'posts' =>  $product]);
    }

    public function edit(string $id)
    {
        //get product by ID
        $product = $this->productService->getById($id);

        //render view with product
        //return view('products.edit', compact('product'));
        return response()->json(['status' => 0, 'posts' =>  $product]);
    }

    /**
     * @group Product
     *
     * 修改產品
     */
    public function update(ProductBaseRequest $request, $id)
    {
        $product = $this->productService->update($request, $id);

        //redirect to index
        //return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
        return response()->json(['status' => 0, 'posts' =>  $product]);
    }

    /**
     * @group Product
     *
     * 刪除產品
     */
    #[QueryParam('id', 'int', '員工ID')]
    public function destroy($id)
    {
        $product = $this->productService->delete($id);

        //redirect to index
        //return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
        return response()->json(['status' => 0, 'posts' =>  $product]);
    }
}
