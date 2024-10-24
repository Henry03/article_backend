<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'article_id' => $this->article_id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'username' => $this->user->name,
            'comment_count' => $this->comment_count,
            'user_liked' => $this->user_liked,
            'like_article_count' => $this->like_article_count,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
