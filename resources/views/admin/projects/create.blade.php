@extends('layouts.admin')

@section('name')
    Add Project
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
    <form action="{{ route('admin.projects.store') }}" method="post" class="p-5 mx-5 rounded-2 bg-dark text-white"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title')  is-invalid @enderror"
                placeholder="" aria-describedby="helpId" value="{{ old('title') }}">
            <small id=" helpId" class="text-muted">*title is mandatory, must be unique and the max length is 50
                chars</small>
        </div>
        <div class="mb-3">
            <label for="github_link" class="form-label">Github link</label>
            <input type="text" name="github_link" id="github_link"
                class="form-control @error('github_link')  is-invalid @enderror" placeholder="" aria-describedby="helpId"
                value="{{ old('github_link') }}">
            <small id=" helpId" class="text-muted">*github link of the project, max 255 chars</small>
        </div>
        <div class="d-flex">
            <div class="mb-3">
                <label for="media" class="form-label">Choose files</label>
                <input type="file" class="form-control @error('media')  is-invalid @enderror" name="media[]"
                    id="media" placeholder="" aria-describedby="fileHelpId" multiple>
                <div id="fileHelpId" class="form-text">*You can choose multiple images using CTRL (max size 10MB)</div>
            </div>
            <div class="mb-3 ms-4">
                <label for="type_id" class="form-label">Types</label>
                <select class="form-select form-select-md @error('type_id')  is-invalid @enderror" name="type_id"
                    id="type_id">
                    <option value="" selected>None</option>
                    @forelse ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @empty
                        No Types in the system..
                    @endforelse
                </select>
            </div>
            <div class="mb-3 ms-5">
                <label for="technologies" class="form-label">Technologies</label>
                <select multiple class="form-select form-select-md" name="technologies[]" id="technologies">
                    <option value="" disabled>Select a technology</option>
                    @forelse($technologies as $technology)
                        <option value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                            {{ $technology->name }}
                        </option>
                    @empty
                        No Technologies in the system...
                    @endforelse
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description')  is-invalid @enderror" name="description" id="description"
                rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="creation_date" class="form-label">Date</label>
            <input type="date" class="form-control @error('creation_date')  is-invalid @enderror" name="creation_date"
                id="creation_date" value="{{ old('creation_date') }}">
        </div>
        <div class="mt-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-secondary">Add</button>
            <a class="btn btn-secondary text-white" href="{{ route('admin.projects.index') }}">Back to projects</a>
        </div>

    </form>
@endsection
