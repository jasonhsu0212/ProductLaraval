<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeBaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email'=>'required|string', 
            'dep_code' => 'required|string',
            'password' => 'required|string',
        ];
    }

     public function bodyParameters()
     {
         return [
             'name'=>['description'=>'員工名稱','example'=>'John'],
             'email'=>['description'=>'員工信箱','example'=>'abc@gmail.com'],
             'password'=>['description'=>'密碼'],  
             'dep_code'=>['description'=>'部門編碼','example'=>'IT'],
         ];
     }
}