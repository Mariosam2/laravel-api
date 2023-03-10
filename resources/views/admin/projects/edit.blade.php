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
        <div class="mb-3">
            <label for="github_link" class="form-label">Github link</label>
            <input type="text" name="github_link" id="github_link"
                class="form-control @error('github_link')  is-invalid @enderror" placeholder="" aria-describedby="helpId"
                value="{{ old('github_link', $project->github_link) }}">
            <small id=" helpId" class="text-muted">*github link of the project, max 255 chars</small>
        </div>
        <div class="upload-img d-flex my-3 gap-5">
            @if ($project->media)
                @if (json_decode($project->media)[0]->type == 'image')
                    <img style="width:240px; height: 180; object-fit: cover;"
                        src="{{ asset('storage/' . json_decode($project->media)[0]->src) }}" alt="{{ $project->title }}">
                @else
                    <video width="240" height="180" controls>
                        <source src='{{ asset('/storage/' . json_decode($project->media)[0]->src) }}'
                            type="{{ Storage::mimeType(json_decode($project->media)[0]->src) }}">
                    </video>
                @endif
            @endif
            <div class="mb-3">
                <label for="media" class="form-label">Choose files</label>
                <input type="file" class="form-control @error('media')  is-invalid @enderror" name="media[]"
                    id="media" placeholder="" aria-describedby="fileHelpId" multiple>
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
                        @else
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
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
