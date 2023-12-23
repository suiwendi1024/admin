<?php

namespace App\Http\Resources\Admin\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'author_name' => $this->author->name,
            'category' => $this->category->name,
            'is_published' => $this->is_published,
            'is_locked' => $this->is_locked,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
