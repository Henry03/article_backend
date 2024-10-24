<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'body' => $this->body,
            'username' => $this->user->name,
            'user_liked' => $this->user_liked,
            'comment_count' => $this->comment_count,
            'like_article_count' => $this->like_article_count,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'comments' => $this->comment->map(function($comment){
                return [
                    'comment_id' => $comment->comment_id,
                    'user_id' => $comment->user_id,
                    'body' => $comment->body,
                    'username' => $comment->user->name,
                    'created_at' => Carbon::parse($comment->created_at)->format('Y-m-d H:i:s'),
                ];
            }),
            'comment_username' => $this->user->name,
            'like' => $this->like_article->map(function($like){
                return [
                    'like_id' => $like->like_id,
                    'user_id' => $like->user_id,
                    'username' => $like->user->name,
                    'created_at' => Carbon::parse($like->created_at)->format('Y-m-d H:i:s'),
                ];
            }),
        ];
    }
}
