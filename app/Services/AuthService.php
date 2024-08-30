<?php

namespace App\Services;

use App\Helper\Logger;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;    

class AuthService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
       
    public function login($email, $password)
    {
        $employee = $this->employeeRepository->login($email, $password);

        // Logger::info('employee', $employee);

        if ($employee) 
        {            
          $pswd = $employee->password;
            if (password_verify($password, $pswd)) 
            {                
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        // logout logic
    }
}
