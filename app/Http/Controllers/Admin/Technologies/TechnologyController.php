<?php

namespace App\Http\Controllers\Admin\Technologies;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnologyStoreRequest;
use App\Http\Requests\TechnologyUpdateRequest;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::orderByDesc('id')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TechnologyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnologyStoreRequest $request)
    {
        $val_data = $request->validated();
        $technology = $val_data;
        Technology::make($val_data)->getTechnologyWithSlug($val_data['name'])->save();
        return to_route('admin.technologies.index')->with('storeMsg', $technology['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TechnologyUpdateRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(TechnologyUpdateRequest $request, Technology $technology)
    {

        $val_data = $request->validated();
        $technology->getTechnologyWithSlug($val_data['name'])->update($val_data);
        return to_route('admin.technologies.index')->with('updateMsg', $technology->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('deleteMsg', $technology->name);
    }
}
