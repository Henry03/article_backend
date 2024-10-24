<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\AuthRequest;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    protected $ArticleRepository;
    public function __construct(ArticleRepository $ArticleRepository)
    {
        $this->ArticleRepository = $ArticleRepository;
    }

    public function index(ArticleRequest $request)
    {
        // dd($request);
        $data = null;
        try {
            // $data = $request->article_id === null
            //     ? $this->ArticleRepository->getArticleall()
            //     : $this->ArticleRepository->getArticleall($request->article_id);

            if ($request->article_id === null) {
                $data = $this->ArticleRepository->getArticleall(null, $request->user_id);
            }
            if ($request->article_id !== null) {
                $data = $this->ArticleRepository->getArticleall($request->article_id, $request->user_id);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data Article Fetched Successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ], status: 400);
        }
    }

    public function indexById(ArticleRequest $request)
    {
        try {
            $data = $this->ArticleRepository->getArticlebyuserid();
            return response()->json([
                'status' => true,
                'message' => 'Data Article Fetched Successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ], status: 400);
        }
    }

    public function store(ArticleRequest $request)
    {

        try {
            $data = $this->ArticleRepository->StoreorUpdate($request);
            return response()->json([
                'status' => true,
                'message' => 'Article Created Successfully',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function update(ArticleRequest $request)
    {

        try {
            $data = $this->ArticleRepository->StoreorUpdate($request);
            return response()->json([
                'status' => true,
                'message' => 'Article Update Successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = $this->ArticleRepository->delete($request->article_id);
            return response()->json([
                'status' => true,
                'message' => 'Article Delete Successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
