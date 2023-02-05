@extends('layouts.admin')
@section('name')
    {{ $project->title }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card col-12 col-md-8 col-xxl-5 p-0 ms-3">
                <div class="media d-flex overflow-auto">
                    @forelse(json_decode($project->media) as $file)
                        @if ($file->type == 'video')
                            <video style="width: 480px; aspect-ratio: 4/3; object-fit:cover;" controls>
                                <source src='{{ asset('/storage/' . $file->src) }}'
                                    type="{{ Storage::mimeType($file->src) }}">
                            </video>
                        @else
                            <img style="width: 480px; aspect-ratio: 4/3; object-fit:cover;"
                                src="{{ asset('storage/' . $file->src) }}" alt="{{ $project->title }}">
                        @endif
                    @empty
                        No media to show..
                    @endforelse
                </div>
                <div class="card-body">
                    <p class="card-text"><span class="fw-bold">Type:
                        </span>{{ $project->type ? $project->type->name : 'None' }}
                    </p>
                    <p class="card-text"><span class="fw-bold">Link:
                        </span>{{ $project->github_link ? $project->github_link : 'None' }}
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">Technologies:</span>
                        @forelse ($project->technologies as $technology)
                            @if ($technology->id === $project->technologies[count($project->technologies) - 1]->id)
                                <span>{{ $technology->name }}</span>
                            @else
                                <span>{{ $technology->name . ',' }}</span>
                            @endif
                        @empty
                            <span>None</span>
                        @endforelse
                    </p>
                    <p class="card-text">{{ $project->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fw-bold">{{ date('d/m/Y', strtotime($project->creation_date)) }}</span>
                        <a class="btn btn-secondary text-white" href="{{ route('admin.projects.index') }}">Back to
                            projects</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
