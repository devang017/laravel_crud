@extends('partials.app')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0">Create User</h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">User Form</h3>
            </div>

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <!-- Single Select -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <!-- Multiple Select -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Skills (Multiple Select)</label>

                            <select name="skills[]" class="form-select select2" multiple>
                                <option value="php">PHP</option>
                                <option value="laravel">Laravel</option>
                                <option value="vue">Vue</option>
                                <option value="react">React</option>
                            </select>
                        </div>

                        <!-- Textarea -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" rows="3" class="form-control"></textarea>
                        </div>

                        <!-- Radio Buttons -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Gender</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="male">
                                <label class="form-check-label">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Hobbies</label>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobbies[]" value="reading">
                                <label class="form-check-label">Reading</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobbies[]" value="sports">
                                <label class="form-check-label">Sports</label>
                            </div>
                        </div>

                        <!-- Switch -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1">
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save User
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection