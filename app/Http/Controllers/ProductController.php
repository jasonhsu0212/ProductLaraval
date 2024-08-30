<?php

namespace App\Http\Controllers;

//import model product

use App\Services\ProductService;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseField;
use App\Http\Requests\ProductListRequest;
use App\Http\Requests\ProductBaseRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\PaginateResource;

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
    #[QueryParam('id', 'int', '員工ID', true)]
    #[ResponseField('name', 'string', '產品名稱')]
    #[ResponseField('description', 'string', '產品說明')]
    #[ResponseField('price', 'int', '金額')]
    #[ResponseField('stock', 'int', '數量')]
    public function index(ProductListRequest $productRequest)
    {
        $keyword = $productRequest->input('keyword', null);
        $page = $productRequest->input('page', 1);
        $pre_page = $productRequest->input('per_page', 10);
        //render view with products
        $data = $this->productService->filter($keyword, $page,$pre_page);
        return $this->success(PaginateResource::make($data, ProductResource::class));
    }



    /**
     * @group Product
     *
     * 新增產品
     */    
     #[ResponseField('status', 'int', '狀態')]
     #[ResponseField('message', 'string', '訊息')]
    public function add(ProductBaseRequest $request)
    {      
        return $this->productService->create($request);
    }

    /**
     * @group Product
     *
     * 查詢單一產品
     */
    #[QueryParam('id', 'int', '員工ID')]
    #[ResponseField('status', 'int', '狀態')]
    #[ResponseField('message', 'string', '訊息')]
    public function show(string $id)
    {
        return $this->productService->getById($id);
    }


    /**
     * @group Product
     *
     * 修改產品
     */    
     #[QueryParam('id', 'int', '員工ID')]
     #[ResponseField('status', 'int', '狀態')]
     #[ResponseField('message', 'string', '訊息')]
    public function update(ProductBaseRequest $request, $id)
    {
        return  $this->productService->update($request, $id);
    }

    /**
     * @group Product
     *
     * 刪除產品
     */
    #[QueryParam('id', 'int', '員工ID')]
    #[ResponseField('status', 'int', '狀態')]
    #[ResponseField('message', 'string', '訊息')]
    public function destroy($id)
    {
        return $this->productService->delete($id);
    }
}
