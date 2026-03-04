@extends('partials.app')
@section('title')
Posts
@endsection
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Posts</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="card">
            <div class="card-header">
                <div class="row w-100 align-items-center">
                    <div class="col-md-6">
                        <h3 class="card-title mb-0">Post List</h3>
                    </div>

                    <div class="col-md-6 text-end">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create Post
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle" id="dataTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Row-->

        <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
</div>
@endsection

@section('script')
<script>
    let postIndexRoute = "{{ route('posts.index') }}";
</script>
@vite(['resources/admin/custom/js/post/datatable.js'])
@endsection