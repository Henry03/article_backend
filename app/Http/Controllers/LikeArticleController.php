<?php

namespace App\Http\Controllers;

use App\Models\LikeArticle;
use App\Http\Requests\StoreLikeArticleRequest;
use App\Http\Requests\UpdateLikeArticleRequest;
use App\Repositories\LikeRepository;

class LikeArticleController extends Controller
{
    protected $likeRepository;
    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeArticleRequest $request)
    {
        try {
            $data = $this->likeRepository->StoreorDelete($request);
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeArticle $likeArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeArticle $likeArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeArticleRequest $request, LikeArticle $likeArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeArticle $likeArticle)
    {
        //
    }
}
