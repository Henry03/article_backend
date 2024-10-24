<?php

namespace App\Repositories;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Comment;
use App\Models\LikeArticle;

class LikeRepository
{
    protected $like;

    public function __construct(LikeArticle $like)
    {
        $this->like = $like;
    }

    public function getLike($id = null)
    {
        if ($id == null) {

            $response = ArticleResource::collection($this->like->all());
            // $response = BrandResource::collection($this->brand->withTrashed()->get());
            return $response;
        }
        $brands = $this->like->find($id);

        $response = new ArticleResource($brands);
        return $response;
    }

    // public function getArticlebyuser_id($user_id)
    // {

    //     $response = ArticleResource::collection($this->article->where('user_id', $user_id)->get());
    //     return $response;
    // }

    public function StoreorDelete($request)
    {

        $existingLike = $this->like->where('user_id', $request->user_id)
        ->where('article_id', $request->article_id)
        ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json([
                'status' => true,
                'message' => 'Like removed'
            ], 200);
        } else {
            $data = $this->like->create([
                'user_id' => $request->user_id,
                'article_id' => $request->article_id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Like added',
                'data' => $data
            ], 201);
        }
    }

    public function delete($id)
    {
        $article = $this->like->find($id);
        if (!$article) {
            throw new \Exception('Article not found', 400);
        }
        $article->delete();
        return $article;
    }
}
