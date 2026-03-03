<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <!--end::Accessibility Features-->

    <!--begin::Required Plugin(AdminLTE)-->
    @vite(['resources/admin/css/adminlte.css'])
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">

        @include('partials._header')
        @include('partials._sidebar')

        <!-- FIXED -->
        <main class="app-main" id="main">
            @yield('content')
        </main>

        @include('partials._footer')

    </div>

    @vite([
    'resources/admin/plugins/jquery.plugin.js',
    'resources/admin/js/adminlte.js',
    'resources/admin/plugins/common-plugins.js',
    'resources/admin/plugins/datatable/datatables-plugin.js'
    ])

    @include('partials.flash-message')

    @yield('script')
</body>
<!--end::Body-->

</html>