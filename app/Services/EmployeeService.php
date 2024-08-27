<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;
 
class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    //
    
    // public function filter(string | null $keyword)
    // {
    //     $this->employeeRepository->filter($keyword);
    //     $filter = $this->employeeRepository;
    // }

    // public function updateBase($data, Employee $employee)
    // {
    //     //$this->query->select('*')->where('user_id',$employee['user_id']);
    //     // if($user){
    //     //     $user->update([
    //     //         'name' => $employee['name']
    //     //     ]);
    //     // }

    // }

    // public function create($name,$email,$password)
    // {
    //   //  $user = 
    // }
}
