@extends('layouts.admin')

@section('name')
    Edit Project
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mx-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.projects.update', $project->slug) }}" method="post"
        class="p-5 mx-5 rounded-2 bg-dark text-white" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title')  is-invalid @enderror"
                placeholder="" aria-describedby="helpId" value="{{ old('title', $project->title) }}">
            <small id="helpId" class="text-muted">*title is mandatory, must be unique and the max length is 50
                chars</small>
        </div>
        <div class="upload-img d-flex my-3 gap-5">
            <img style="width:240px; height: auto;" src="{{ asset('storage/' . $project->img) }}"
                alt="{{ $project->title }}">
            <div class="mb-3">
                <label for="img" class="form-label">Choose file</label>
                <input type="file" class="form-control @error('img')  is-invalid @enderror" name="img" id="img"
                    placeholder="" aria-describedby="fileHelpId" value="{{ old('img', $project->img) }}">
                <div id="fileHelpId" class="form-text">*max size 300KB</div>
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Types</label>
                <select class="form-select form-select-md" name="type_id" id="type_id">
                    <option value="" selected>None</option>
                    @foreach ($types as $type)
                        @if ($project->type)
                            <option value="{{ $type->id }}"
                                {{ old('type_id', $project->type->id) == $type->id ? 'selected' : '' }}>{{ $type->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3 ms-5">
                <label for="technologies" class="form-label">Technologies</label>
                <select multiple class="form-select form-select-md" name="technologies[]" id="technologies">
                    <option value="" disabled>Select a technology</option>
                    @forelse($technologies as $technology)
                        @if ($errors->any())
                            <option value="{{ $technology->id }}"
                                {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                                {{ $technology->name }}
                            </option>
                        @elseif(!$project->technologies->isEmpty())
                            <option
                                value="{{ $technology->id }}"{{ $project->technologies->contains($technology->id) ? 'selected' : '' }}>
                                {{ $technology->name }}
                            </option>
                        @else
                            <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                        @endif
                    @empty
                        This item has no technologies
                    @endforelse
                </select>
            </div>
        </div>

        <div class=" mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description')  is-invalid @enderror" name="description" id="description"
                rows="3">{{ old('description', $project->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="creation_date" class="form-label">Date</label>
            <input type="date" class="form-control @error('creation_date')  is-invalid @enderror" name="creation_date"
                id="creation_date" value="{{ old('creation_date', $project->creation_date) }}">
        </div>
        <div class="mt-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-secondary">Edit</button>
            <a class="btn btn-secondary text-white" href="{{ route('admin.projects.index') }}">Back to projects</a>
        </div>

    </form>
@endsection
