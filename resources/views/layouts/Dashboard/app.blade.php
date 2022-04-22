<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    @include('partials.styles')
</head>
{{--<body class="hold-transition sidebar-mini layout-fixed">--}}
<body class="hold-transition sidebar-mini layout-fixed" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<div class="wrapper">
    <!-- Navbar -->
@include('sweetalert::alert')

@include('partials.navbar')
<!-- /.navbar -->
    <!-- Main Sidebar Container -->
@include('layouts.Dashboard.aside')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
        @include('partials.errors')
        @include('partials.session')
    </div>
    <!-- /.content-wrapper -->
@include('partials.footer')
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('partials.scripts')
</body>
</html>
