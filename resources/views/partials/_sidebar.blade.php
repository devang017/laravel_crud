<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ Vite::asset('resources/admin/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">

                <li class="nav-item {{ activeMenu('dashboard') }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @canany(['author_list', 'role_list', 'permission_list'])
                <li class="nav-item {{ activeSubMenu(['users', 'roles', 'permissions']) }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    @can('author_list')
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ activeMenu('users') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                    @endcan
                    @can('role_list')
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ activeMenu('roles') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                    @endcan
                    @can('permission_list')
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link {{ activeMenu('permissions') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </li>
                @endcanany
                @can('category_list')
                <li class="nav-item {{ activeMenu('categories') }}">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                @endcan
                @can('post_list')
                <li class="nav-item {{ activeMenu('posts') }}">
                    <a href="{{ route('posts.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Posts
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>