<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'name'=> $this->name,
            'description'=> $this->description,
            'price'=> $this->price,
            'srock'=> $this->srock,
        ];
    }
}
