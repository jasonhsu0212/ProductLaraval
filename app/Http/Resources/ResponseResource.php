<?php

namespace App\Http\Resources;

use App\Helper\Logger;
use Illuminate\Http\Resources\Json\JsonResource;

// class ResponseResource extends JsonResource
// {
//     /**
//      * Transform the resource into an array.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray($request): array
//     {
   
//         return [
//             // 'code' => response(),
//             // 'data' => EmployeeResource::collection($request),
//         ];
//     }
// }


class ResponseResource extends JsonResource
{

     public function __construct($resource)
     {
         return [
             'data'=> EmployeeResource::make($resource),
            // 'email'=> $this->email,
            // 'dep_code'=> $this->dep_code,
        ];
     }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray($request): array
     {
         Logger::info('ResponseResource', $request);
         return [
              'data'=> EmployeeResource::make($request),
              'code'=> 1,
             // 'dep_code'=> $this->dep_code,
         ];
     }

}
