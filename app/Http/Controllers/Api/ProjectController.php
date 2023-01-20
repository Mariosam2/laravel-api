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
        // $project is a collection of a single project, 
        if (count($project) > 0) {
            return response()->json([
                'success' => true,
                'result' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => null
            ]);
        }
    }
}
