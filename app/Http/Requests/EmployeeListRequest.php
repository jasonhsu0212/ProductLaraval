<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    

    public function rules()
    {
        return [
            'page' => 'required|integer',
            'dep_code' => 'nullable|string',
            'keyword' => 'nullable|string',
        ];
    }

    public function queryParameters()
    {
        return [
            'page'=>['description'=>'頁碼','example'=>1],
            'dep_code'=>['description'=>'部門編碼','example'=>'IT'],
            'keyword'=>['description'=>'模糊查詢用戶名稱或信箱','example'=>'John'],
        ];
    }
}