<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    

    public function rules()
    {
        return [
            'page' => 'required|integer',
            'keyword' => 'nullable|string',
            'per_page' => 'required|integer',
        ];
    }

    public function queryParameters()
    {
        return [
            'page'=>['description'=>'頁碼','example'=>1],
            'keyword'=>['description'=>'模糊查詢產品名稱或內容','example'=>'可食用'],
            'per_page'=>['description'=>'每頁顯示筆數','example'=>10],
        ];
    }
}