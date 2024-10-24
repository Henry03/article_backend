<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $CommentRepository;
    public function __construct(CommentRepository $CommentRepository)
    {
        $this->CommentRepository = $CommentRepository;
    }

    public function index(Request $request)
    {
        try {
            $data = $request->comment_id === null
                ? $this->CommentRepository->getComment()
                : $this->CommentRepository->getComment($request->comment_id);

            return response()->json([
                'status' => 200,
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
    public function store(Request $request)
    {
        try {
            $data = $this->CommentRepository->StoreorUpdate($request);
            return response()->json([
                'status' => true,
                'message' => 'Comment Created Successfully',
                'data' => $data
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $data = $this->CommentRepository->delete($request->article_id);
            return response()->json([
                'status' => true,
                'message' => 'Article Delete Successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
