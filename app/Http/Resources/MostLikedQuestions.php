<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostLikedQuestions extends JsonResource
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
            'content' => $this->content,
            'slug' => $this->slug,
            'category_name' => $this->category_name,
            'created_at' => $this->created_at,
            'author' => $this->user_name ?? 'admin',
            'likes_count' => $this->likes_count ?? 0
        ];
    }
}
