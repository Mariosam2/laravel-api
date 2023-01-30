@extends('layouts.admin')
@section('name')
    Projects
    <a class="text-dark" href="{{ route('admin.projects.create') }}">
        <i class="fa-solid fa-square-plus mx-2"></i>
    </a>
@endsection
@section('content')
    <div class="container mt-4">
        @if (Session::has('storeMsg'))
            <div class="alert alert-success" role="alert">
                <strong>{{ Session::get('storeMsg') }}</strong> created successfully
            </div>
        @elseif(Session::has('updateMsg'))
            <div class="alert alert-success" role="alert">
                <strong>{{ Session::get('updateMsg') }}</strong> updated successfully
            </div>
        @elseif(Session::has('deleteMsg'))
            <div class="alert alert-danger" role="alert">
                <strong>{{ Session::get('deleteMsg') }}</strong> deleted succesfully
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped
    table-hover	
    table-borderless
    table-light
    align-middle">
                <thead class="table-dark">

                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($projects as $project)
                        <tr class="table-light">
                            <td scope="row" class="pe-3 fw-bold">{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td class="d-flex table-media align-items-center ">
                                @if (isset($project->media))
                                    @forelse(json_decode($project->media) as $file)
                                        @if ($file->type == 'video')
                                            <video style="width:320px; height:240px; object-fit: cover; margin: 0.5rem"
                                                controls>
                                                <source src='{{ asset('/storage/' . $file->src) }}'
                                                    type="{{ Storage::mimeType($file->src) }}">
                                            </video>
                                        @else
                                            <img style="width:320px; height:240px; object-fit: cover; margin: 0.5rem"
                                                src="{{ asset('storage/' . $file->src) }}" alt="{{ $project->title }}">
                                        @endif
                                    @empty
                                        No images...
                                    @endforelse
                                @endif
                            </td>
                            <td class="pe-3">{{ date('d/m/Y', strtotime($project->creation_date)) }}</td>
                            <td>
                                <a class="d-flex text-white  p-3 py-2 m-2 bg-primary justify-content-center rounded-2"
                                    href="{{ route('admin.projects.show', $project->slug) }}"><i
                                        class="fa-solid fa-eye"></i></a>
                                <a class="d-flex text-white  p-3 py-2 m-2 bg-secondary justify-content-center rounded-2"
                                    href="{{ route('admin.projects.edit', $project->slug) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('admin.projects.destroy', $project->slug) }}"
                                    class="m-2 bg-danger rounded-2" method="post" enctype="multipart/form-data">
                                    @method('DELETE')
                                    @csrf
                                    <!-- Modal trigger button -->
                                    <button type="button"
                                        class="btn  p-3 py-2 w-100 d-flex text-white justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#modal{{ $project->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modal{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modal{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitle{{ $project->id }}">Deleting
                                                        <strong class="text-danger">{{ $project->title }}</strong>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <div class="d-flex">
            {{ $projects->links() }}
        </div>

    </div>
@endsection
