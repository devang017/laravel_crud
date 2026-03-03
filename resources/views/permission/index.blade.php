@extends('partials.app')
@section('title')
Dashboard
@endsection
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Permissions</li>
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
                        <h3 class="card-title mb-0">Permission List</h3>
                    </div>

                    <div class="col-md-6 text-end">
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Create Permission
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
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
    let permissionIndexRoute = "{{ route('permissions.index') }}";
</script>
@vite(['resources/admin/custom/js/permission/datatable.js'])
@endsection