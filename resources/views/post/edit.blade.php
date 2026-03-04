@extends('partials.app')

@section('title')
Edit Post
@endsection

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Post</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Post Form</h3>
            </div>

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter full name" value="{{ old('title', $post->title) }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">status</label>
                            <select name="status" class="form-select">
                                <option value="draft" @selected($post->status == 'draft')>Draft</option>
                                <option value="published" @selected($post->status == 'published')>Published</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Single Select -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Categories</label>
                            <select name="categories[]" class="form-select select2" multiple>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($post->categories?->contains($category->id))>{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags" value='@json($post->tags->pluck("name")->map(fn($tag)=>["value"=>$tag]))'>
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" cols="30" rows="10">{{ $post->content }}</textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update Post
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection

<script>
    let searchTagsRoute = "{{ route('tags.search') }}";
</script>
@section('script')
@vite('resources/admin/custom/js/post/edit.js')
@endsection