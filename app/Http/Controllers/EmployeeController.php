<?php

namespace app\Http\Controllers;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseField;
use App\Services\EmployeeService;
use App\Http\Requests\EmployeeBaseRequest;
use App\Http\Requests\EmployeeListRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\PaginateResource;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

/**
 * @group Employee
 * 
 * 員工管理
 */
class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
         $this->middleware('auth:api');
    }

    /**
     * @group Employee
     *
     * 查詢員工
     */
    #[ResponseField('name', 'string', '員工名稱')]
    #[ResponseField('email', 'string', '信件')]
    #[ResponseField('dep_code', 'string', '部門編碼')]
    public function index(EmployeeListRequest $employeeRequest)
    {
        // return $this->success((object) [
        //     'code' => 'test',
        //     'message' => 'sss']);
        $keyword = $employeeRequest->input('keyword', null);
        $dep_code = $employeeRequest->input('dep_code', null);
        $page = $employeeRequest->input('page', 1);
        $pre_page = $employeeRequest->input('per_page', 10);
        Logger::info('EmployeeController.index', ['keyword' => $keyword, 'dep_code' => $dep_code, 'page' => $page, 'pre_page' => $pre_page]);
        $data = $this->employeeService->filter($keyword, $dep_code, $page, $pre_page);
        return $this->success(PaginateResource::make($data, EmployeeResource::class), '查詢成功');
    }

    /**
     * @group Employee
     *
     * 新增員工
     */
    #[ResponseField('code', 'int', '狀態碼')]
    #[ResponseField('message', 'string', '訊息')]
    public function createEmployee(EmployeeBaseRequest $request)
    {
        $data = $this->employeeService->create($request);
        return $this->success($data);
    }

    /**
     * @group Employee
     *
     * 員工修改
     */
    #[QueryParam('id', 'int', '員工ID', true)]
    #[ResponseField('code', 'int', '狀態碼')]
    #[ResponseField('message', 'string', '訊息')]
    public function updateEmployee(EmployeeBaseRequest $request, $id)
    {
        $data = $this->employeeService->updateBase($request, $id);
        return $this->success($data);
    }

    /**
     * @group Employee
     *
     * 修改密碼
     */
    //  #[QueryParam('name','string','員工姓名',false)] 
    //  #[ResponseField('id','int','員工ID')]
    //  public function changePassword($request)
    //  {
    //      return $this->employeeService->changePassword($request);
    //  }


}
