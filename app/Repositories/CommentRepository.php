<?php

namespace App\Repositories;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getComment($id = null)
    {
        if ($id == null) {

            $response = ArticleResource::collection($this->comment->all());
            // $response = BrandResource::collection($this->brand->withTrashed()->get());
            return $response;
        }
        $brands = $this->comment->find($id);

        $response = new ArticleResource($brands);
        return $response;
    }

    // public function getArticlebyuser_id($user_id)
    // {

    //     $response = ArticleResource::collection($this->article->where('user_id', $user_id)->get());
    //     return $response;
    // }

    public function StoreorUpdate($request)
    {

        if ($request->id != null && !$this->comment->find($request->id)) {
            throw new \Exception('Brand not found', 400);
        }
        $data = $this->comment->updateOrCreate(
            [
                'comment_id' => $request->id
            ],
            [
                'user_id' => $request->user_id,
                'article_id' => $request->article_id,
                'body' => $request->body
            ]
        );
        return $data;
    }

    public function delete($id)
    {
        $article = $this->comment->find($id);
        if (!$article) {
            throw new \Exception('Article not found', 400);
        }
        $article->delete();
        return $article;
    }
}
