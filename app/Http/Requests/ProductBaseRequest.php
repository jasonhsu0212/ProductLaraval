<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductBaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description'=>'nullable|string', 
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ];
    }

     public function bodyParameters()
     {
         return [
             'name'=>['description'=>'產品名稱','example'=>'小米酒'],
             'description'=>['description'=>'產品說明','example'=>'可飲用'],
             'price'=>['description'=>'價格','example'=>100],  
             'stock'=>['description'=>'數量','example'=>5],
         ];
     }
}