<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->with('type', 'technologies')->paginate(3);
        return response()->json(
            [
                'success' => true,
                'result' => $projects
            ]
        );
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->get();
        return response()->json([
            'success' => true,
            'result' => $project
        ]);
    }
}
