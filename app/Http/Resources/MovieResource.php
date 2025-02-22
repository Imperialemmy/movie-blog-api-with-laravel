<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'description' => $this->description,
            'release_date' => $this->release_date ? $this->release_date->format('Y-m-d') : null,
            'genres' => GenreResource::collection($this->whenLoaded('genres')), // Include genres
            'blog_posts' => BlogPostResource::collection($this->whenLoaded('blogPosts')), // Include related blog posts
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
