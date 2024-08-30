<?php

namespace App\Repositories;

use App\Helper\Logger;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
USE Illuminate\Support\Facades\Log;

class EmployeeRepository 
{
    public function model() : string
    {
        return Employee::class;
    }

    protected $query;

    public function find(string | null $keyword,string | null $department_code)
    {
        $this->query = Employee::query();
             
        if($department_code){
            
                $this->query->where('dep_code','=',$department_code);
            }

        //閉包(name like '%keyword%' or email like '%keyword%')
        if($keyword){
            $this->query->where(function($query) use ($keyword){
                $query->where('name','like','%'.$keyword.'%');
                $query->orWhere('email','like','%'.$keyword.'%');
            });
            
        }

        $model = $this->query->get();

        return $model;
    }
    public function add($data)
    { 
        try {
            Employee::create($data->all());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
     
    }
       
    public function update($data)
    {
        $data->update();
    }

    public function list()
    {
        return Employee::all();
    }
    public function delete($data)
    {        
         //delete data
         $data->delete();
    }

    public function getById($id)
    {        
        return Employee::findOrFail($id);
    }


    
}
