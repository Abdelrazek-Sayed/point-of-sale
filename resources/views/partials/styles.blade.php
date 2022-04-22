<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>POS Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('dashboard/rtl/plugins/summernote/summernote-bs4.css')}}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


@if(app()->getLocale() == 'ar')
<!-- Bootstrap 4 RTL -->
<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css'">
<!-- Custom style for RTL -->
<link rel="stylesheet" href="{{asset('dashboard/dist/css/custom.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/dist/css/rtl/bootstrap-rtl.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/dist/css/rtl/bootstrap-rtl.css.map')}}">
<link rel="stylesheet" href="{{asset('dashboard/dist/css/rtl/bootstrap-rtl.min.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/dist/css/rtl/bootstrap-rtl.min.css.map')}}">
@endif
<script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
></script>
@yield('styles')