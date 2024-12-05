<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostVieweQuestions extends JsonResource
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
            'slug' => $this->slug,
            'category_name' => $this->category_name,
            'likes_count' => $this->likes_count ?? 0,
            'views' => $this->views ?? 0,
            'created_at' => $this->created_at
        ];
    }
}
