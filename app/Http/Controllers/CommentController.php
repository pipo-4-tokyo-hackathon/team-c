<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Comment::query();
        if (request()->has('project_id')) {
            $query->where('project_id', request()->project_id);
        }

        $data = $query->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = Comment::create([
            'user_id' => $request->input('user_id'),
            'project_id' => $request->input('project_id'),
            'body' => $request->input('body'),
            'status' => 'active',
        ]);

        return response()->json([
            'status' => $status ? 'success' : 'failed',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $status = $comment->update([
            'body' => $request->input('body'),
        ]);

        return response()->json([
            'status' => $status ? 'success' : 'failed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
