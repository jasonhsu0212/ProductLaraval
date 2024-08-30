<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentRepository 
{
    public function getByCode($code)
    {       
        return Department::query()->where('dep_code',$code);
    }
    
}
