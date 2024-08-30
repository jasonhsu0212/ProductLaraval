<?php

namespace app\Http\Controllers;

use App\Helper\Logger;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseField;
use App\Services\EmployeeService;
use Illuminate\Routing\Controller;
use App\Http\Requests\EmployeeBaseRequest;
use App\Http\Requests\EmployeeListRequest;
use GuzzleHttp\Psr7\Request;

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
    #[ResponseField('id', 'int', '員工ID')]
    public function index(EmployeeListRequest $employeeRequest)
    {

        $keyword = $employeeRequest->input('keyword', null);
        $dep_code = $employeeRequest->input('dep_code', null);

        Logger::info('EmployeeController.index', ['keyword' => $keyword, 'dep_code' => $dep_code, 'request' => $employeeRequest->all()]);

        return $this->employeeService->filter($keyword, $dep_code);
    }




    /**
     * @group Employee
     *
     * 新增員工
     */
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
