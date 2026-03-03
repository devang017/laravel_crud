@extends('partials.app')

@section('title')
Edit Role
@endsection

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Role</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Role Form</h3>
            </div>

            <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT');
                <div class="card-body">

                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter role name" value="{{ old('name', $role->name) }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="Enter role slug" value="{{ old('slug', $role->slug) }}">
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Single Select -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ old('description', $role->description) }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Permissions</label>
                            <select name="permissions[]" class="form-select select2" multiple>

                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}" @selected($role->permissions->contains($permission->id))>{{ ucfirst($permission->name) }}</option>
                                @endforeach
                            </select>
                            @error('permissions')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save Role
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection


@section('script')
@vite('resources/admin/custom/js/role/edit.js')
@endsection