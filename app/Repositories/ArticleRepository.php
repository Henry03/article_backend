<?php

namespace App\Repositories;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticlesResource;
use App\Http\Resources\BrandResource;
use App\Models\Article;
use App\Models\Brand;

class ArticleRepository
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticleall($id = null, $user_id = null)
    {
        if ($id == null) {
            $response = $this->article->withcount('comment')->withcount('like_article')->orderBy('created_at', 'desc')->get();

            $response->map(function ($article) use ($user_id) {
                
                $article->user_liked = $article->like_article->contains('user_id', $user_id);
                return $article;
            });
            
            return ArticlesResource::collection($response);
        }
        $article = $this->article->withcount('comment')->withcount('like_article')->with('comment.user')->with('like_article.user')->find($id);

        $article->user_liked = $article->like_article->contains('user_id', $user_id);

        $response = new ArticleResource($article);
        return $response;
    }


    public function getArticlebyuserid()
    {
        $user_id = auth()->user()->user_id;
        $response = $this->article->where('user_id', $user_id)->withcount('comment')->withcount('like_article')->orderBy('created_at', 'desc')->get();
        $response->map(function ($article) use ($user_id) {
                
            $article->user_liked = $article->like_article->contains('user_id', $user_id);
            return $article;
        });
        
        return ArticlesResource::collection($response);
    }

    public function StoreorUpdate($request)
    {

        if ($request->id !== null && !$this->article->find($request->id)) {
            throw new \Exception('Article not found', 404);
        }
        $data = $this->article->updateOrCreate(
            [
                'article_id' => $request->article_id
            ],
            [
                'user_id' => $request->user_id,
                'title' => $request->title,
                'description' => $request->description,
                'body' => $request->body
            ]
        );
        return $data;
    }

    public function delete($id)
    {
        $article = $this->article->find($id);
        if (!$article) {
            throw new \Exception('Article not found', 400);
        }
        $article->delete();
        return $article;
    }
}
