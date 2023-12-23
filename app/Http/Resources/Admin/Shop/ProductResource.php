<?php

namespace App\Http\Resources\Admin\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name,
            'price' => $this->price,
            'cost' => $this->cost,
            'stock' => $this->stock,
            'is_available' => $this->is_available,
            'available_from' => $this->available_from,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
