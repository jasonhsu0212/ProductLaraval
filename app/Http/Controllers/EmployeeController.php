<?php

namespace app\Http\Controllers;

use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseField;
use App\Services\EmployeeService;
use Illuminate\Routing\Controller;
use App\Http\Requests\EmployeeBaseRequest;
use App\Http\Requests\EmployeeListRequest;

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
        $keyword = $employeeRequest->input('keyword', null);
        $dep_code = $employeeRequest->input('dep_code', null);

        return $this->employeeService->filter($keyword, $dep_code);
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
        return $this->employeeService->create($request);
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
        return $this->employeeService->updateBase($request, $id);
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
