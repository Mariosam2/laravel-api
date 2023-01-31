<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Span;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->with('type', 'technologies')->paginate(3);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        //dd($request);
        $val_data = $request->validated();
        //dd($val_data);
        if (isset($val_data['media'])) {
            foreach ($val_data['media'] as $key => $file) {
                $file_path = Storage::put('media-' . Str::slug($val_data['title']), $file);
                $val_data['media'][$key]->src = $file_path;
                if (Storage::mimeType($file_path) == 'image/jpg' || Storage::mimeType($file_path) == 'image/png' || Storage::mimeType($file_path) == 'image/jpeg' || Storage::mimeType($file_path) == 'image/webp' || Storage::mimeType($file_path) == 'image/gif') {
                    $val_data['media'][$key]->type = 'image';
                } else {
                    $val_data['media'][$key]->type = 'video';
                }
            }
            $val_data['media'] = json_encode($val_data['media']);
        }



        //dd($val_data);

        $project = Project::make($val_data)->getProjectWithSlug($val_data['title']);
        //dd($project);
        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }



        return to_route('admin.projects.index')->with('storeMsg', $project->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //dd($project);
        //dd($project->type());
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ProjectUpdateRequest;  $request
     * @param   Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $val_data = $request->validated();
        //dd($request);
        if (isset($val_data['media'])) {
            //dd(json_decode($project->media));
            foreach (json_decode($project->media) as $file) {
                //dd($file);
                Storage::delete($file->src);
            }
            foreach ($val_data['media'] as $key => $file) {
                $file_path = Storage::put('media-' . Str::slug($val_data['title']), $file);
                $val_data['media'][$key]->src = $file_path;
                if (Storage::mimeType($file_path) == 'image/jpg' || Storage::mimeType($file_path) == 'image/png' || Storage::mimeType($file_path) == 'image/jpeg' || Storage::mimeType($file_path) == 'image/webp' || Storage::mimeType($file_path) == 'image/gif') {
                    $val_data['media'][$key]->type = 'image';
                } else {
                    $val_data['media'][$key]->type = 'video';
                }
            }
            $val_data['media'] = json_encode($val_data['media']);
        } else if (isset($project->media)) {

            //dd(File::name(json_decode($project->media)[0]->src));

            $val_data['media'] = json_decode($project->media);
            foreach ($val_data['media'] as $key => $file) {

                $val_data['media'][$key]->src = 'media-' . Str::slug($val_data['title']) . '/' . File::basename($file->src);
            }
            Storage::move('media-' . $project->slug, 'media-' . Str::slug($val_data['title']), false);
        }



        //dd($val_data);
        $project->getProjectWithSlug($val_data['title'])->update($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        }
        return to_route('admin.projects.index')->with('updateMsg', $project->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //dd($project);
        if ($project->media) {
            Storage::deleteDirectory('media-' . $project->slug);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('deleteMsg', $project->title);
    }
}
