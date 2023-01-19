<?php

namespace App\Http\Controllers\Admin\Types;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests\TypeUpdateRequest;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->get();
        return view('admin.types.index', compact('types'));
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
     * @param  \App\Http\Requests\TypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeStoreRequest $request)
    {
        $val_data = $request->validated();
        $type = $val_data;
        Type::make($val_data)->getTypeWithSlug($val_data['name'])->save();
        return to_route('admin.types.index')->with('storeMsg', $type['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TypeUpdateRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(TypeUpdateRequest $request, Type $type)
    {
        //dd($request);
        //dd($type->id);
        //$request->prepareForValidation();
        //dd($request);
        $val_data = $request->validated();
        //dd($val_data);
        $type->getTypeWithSlug($val_data['name'])->update($val_data);
        return to_route('admin.types.index')->with('updateMsg', $type->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('deleteMsg', $type->name);
    }
}
