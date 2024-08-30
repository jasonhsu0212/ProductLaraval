<?php

namespace App\Http\Resources;

use App\Helper\Logger;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        Logger::info('EmployeeResource', $request);
        return [
            'name'=> $this->name,
            'email'=> $this->email,
            'dep_code'=> $this->dep_code,
        ];
    }

}