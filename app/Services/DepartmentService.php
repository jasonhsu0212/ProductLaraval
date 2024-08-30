<?php

namespace App\Services; 

use App\Repositories\DepartmentRepository;

class  DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }
    //
    
     public function getByCode(string $code)
     {
        return $this->departmentRepository->getByCode($code);
     }

 
}