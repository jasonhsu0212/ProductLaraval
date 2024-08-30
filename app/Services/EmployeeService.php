<?php

namespace App\Services;

use App\Helper\Logger;
use App\Repositories\EmployeeRepository;
use App\Repositories\DepartmentRepository;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Response;
use App\Http\Resources\ResponseResource;

class EmployeeService
{
    protected $employeeRepository, $departmentRepository;

    public function __construct(EmployeeRepository $employeeRepository, DepartmentRepository $departmentRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
    }
    //

    public function filter(string | null $keyword, string | null $department_code)
    {
        $employee =  $this->employeeRepository->find($keyword, $department_code);
        return response(EmployeeResource::collection($employee), Response::HTTP_OK);
    }

    // public function getList()
    // {
    //     return $this->employeeRepository->getById(3);
    // }


    public function create($request)
    {
        try {
            $dep = $this->departmentRepository->getByCode($request->dep_code);

            if (!$dep) {
                return response()->json(['message' => 'Department not found','code'=>0], 404);
            }

            $request->validate([
                'name'         => 'required|string',
                'email'   => 'required|string',
                'dep_code'          => 'required|min:1',
                'password'       => 'required|string',
            ]);

            $this->employeeRepository->add($request);

            return response()->json(['message' => 'Employee created','code'=>1], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'code'=>0], 500);
        }
    }

    public function updateBase($request, $id)
    {
        try {
            //get employee by ID
            $employee = $this->employeeRepository->getById($id);

            $dep = $this->departmentRepository->getByCode($request->dep_code);

            if (!$dep) {
                return response()->json(['message' => 'Department not found','code'=>0], 404);
            }

            //validate form
            $request->validate([
                'name'         => 'required|min:5',
                'email'   => 'required|min:10',
                'dep_code'         => 'required|min:1',
                'password'         => 'required|min:6',
            ]);


            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->dep_code = $request->dep_code;
            $employee->password = $request->password;

            //update employee 
            $this->employeeRepository->update($employee);

            return response()->json(['message' => 'Employee updated','code'=>1], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'code'=>0], 500);
        }
    }

    public function changePassword($request)
    {
        //get employee by ID
        $employee = $this->employeeRepository->getById($request->id);

        $employee->password = $request->password;

        //update employee 
        $this->employeeRepository->update($employee);

        return response()->json(['message' => 'Password changed','code'=>1], 200);
    }

    public function delete($id)
    {
        //get employee by ID
        $employee = $this->employeeRepository->getById($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found','code'=>0], 404);
        }
        //delete employee
        $employee->delete($employee);

        return response()->json(['message' => 'Employee deleted','code'=>1], 200);
    }
}
