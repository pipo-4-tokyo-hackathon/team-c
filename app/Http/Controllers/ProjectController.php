<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Gemini\Enums\ModelType;
use Illuminate\Support\Facades\Log;
use Gemini\Laravel\Facades\Gemini;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(json_encode(request()->all()));
        $query = Project::query();
        if (request()->has('tag')) {
            $tag = request()->tag;
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('tag', $tag);
            });
        }

        if (request()->has('search')) {
            $query->where('title', 'like', '%' . request()->search . '%');
        }

        if (request()->has('user_id')) {
            $user_id = request()->user_id;
            $query->whereHas('users', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });
        }

        $data = $query->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function generateSummary(Project $project): void
    {
        $text = 'project title: ' . $project->title;
        foreach ($project->comments as $comment){
            $text .= 'comment of ' . $comment->user_fullname . ': ' . $comment->body . '/n';
            if ($comment->notes) {
                $text .= 'notes to previous comment: ';
                foreach ($comment->notes as $note) {
                    $text .= $note->user_fullname . ': ' . $note->body . '/n';
                }
            }
        }
        $result = Gemini::generativeModel(ModelType::GEMINI_FLASH)->generateContent(
            'Build a short summary of 5-6 sentences of comments below /n' . $text
        );

        $project->summary = $result->text();
        $project->save();
    }
}
