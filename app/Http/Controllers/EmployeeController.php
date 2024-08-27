<?php
 

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController  
{
    protected $employeeSerice;

    // public function __construct(EmployeeService $employeeService)
    // {
    //     $this->employeeService = $employeeService;
    // }

    // //
    // #[QueryParam('keyword','string','模糊查詢',false)]
    // public function index(EmployeeRequest $employeeRequest)
    // {
    //     $keyword = $employeeRequest->input('keyword',null);

    //    // return $this->employeeService->filter($keyword);
    // }

    // public function updateEmployee(EmployeeRequest $request,Employee $employee)
    // {
    //     return $this->employeeService->updateBase($request);
    // }
}
