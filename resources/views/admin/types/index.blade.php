@extends('layouts.admin')

@section('name')
    Types
@endsection

@section('content')
    <div class="container mt-4 ms-2">
        <div class="row">
            <div class="col-12 col-xxl-5">
                <form action="{{ route('admin.types.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name', 'store') is-invalid @enderror">
                            <button type="submit"
                                class="input-group-text btn btn-dark rounded-end"id="inputGroup-sizing-default">Add
                                <i class="fa-solid fa-plus ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
                @if ($errors->store->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->store->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-12 col-xxl-7">
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
                    <table
                        class="table table-striped
                        table-hover	
                        table-borderless
                        table-light
                        align-middle">
                        <thead class="table-dark">

                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="d-flex justify-content-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @forelse($types as $type)
                                <tr class="table-light">
                                    <td scope="row" class="pe-5 fw-bold">{{ $type->id }}</td>
                                    <td class="pe-5">
                                        <form action="{{ route('admin.types.update', $type->slug) }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <div class="py-2">
                                                <div class="input-group">
                                                    <input type="text" name="name" id="{{ 'name-' . $type->id }}"
                                                        value="{{ $type->name }}"
                                                        class="form-control @error('name', $type->slug) is-invalid @enderror">
                                                    <button type="submit"
                                                        class="input-group-text btn btn-secondary rounded-end"id="inputGroup-sizing-default">Edit
                                                        <i class="fa-regular fa-pen-to-square ms-2"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                        @if ($errors->getBag($type->slug)->any())
                                            <div class="alert alert-danger m-0 p-2">
                                                <ul class="m-0">
                                                    @foreach ($errors->getBag($type->slug)->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="pe-5">{{ $type->slug }}</td>
                                    <td>
                                        <form action="{{ route('admin.types.destroy', $type->slug) }}"
                                            class="p-5 rounded-2" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <!-- Modal trigger button -->
                                            <button type="button"
                                                class="btn p-3 py-2 text-white w-100 bg-danger text-align-center"
                                                data-bs-toggle="modal" data-bs-target="#modal{{ $type->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modal{{ $type->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modal{{ $type->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitle{{ $type->id }}">
                                                                Deleting <strong
                                                                    class="text-danger">{{ $type->name }}</strong></h5>
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
            </div>
        </div>
    </div>
@endsection
