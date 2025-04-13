<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Note::query();

        if (request()->has('comment_id')) {
            $query->where('comment_id', request()->comment_id);
        }

        return response()->json([
            'data' => $query->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = Note::create([
            'user_id' => $request->input('user_id'),
            'comment_id' => $request->input('comment_id'),
            'body' => $request->input('body'),
            'status' => 'new',
        ]);

        return response()->json([
            'status' => $status ? 'success' : 'failed',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
