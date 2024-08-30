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
    #[QueryParam('id', 'int', '員工ID', true)]
    #[ResponseField('name', 'string', '產品名稱')]
    #[ResponseField('description', 'string', '產品說明')]
    #[ResponseField('price', 'int', '金額')]
    #[ResponseField('stock', 'int', '數量')]
    public function index(ProductListRequest $productRequest)
    {
        $keyword = $productRequest->input('keyword', null);
        $page = $productRequest->input('page', null);
        //render view with products
        return $this->productService->filter($keyword, $page);
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
