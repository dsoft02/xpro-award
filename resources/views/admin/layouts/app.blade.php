<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{ getPageTitle($pageTitle ?? '') }}</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Scripts -->

      <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/font-awesome/css/font-awesome.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/Ionicons/css/ionicons.min.css') }}">
      <!-- daterange picker -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
      <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/all.css') }}">
      <!-- Bootstrap Color Picker -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
      <!-- Bootstrap time Picker -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.css') }}">
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/plugins/sumoselect/sumoselect.min.css') }}">
      <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

       @stack('styles')

      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('backend/css/AdminLTE.min.css') }}">
      <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect. -->
      <link rel="stylesheet" href="{{ asset('backend/css/skins/skin-blue.min.css') }}">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Google Font -->
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="{{ asset('backend/css/customstyle.css') }}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="logo">
                  <!-- mini logo for sidebar mini 50x50 pixels -->
                  <span class="logo-mini"><b>A</b>LT</span>
                  <!-- logo for regular state and mobile devices -->
                  <span class="logo-lg"><b>XPRO Award 2024</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                  <!-- Sidebar toggle button-->
                  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                  </a>
                  <!-- Navbar Right Menu -->
                  <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                              <li>
                                    <a href="{{ route('home') }}" title="Visit Website" target="_blank"><i class="fa fa-globe"></i></a>
                              </li>
                              <!-- /.messages-menu -->
                              <!-- User Account Menu -->
                              <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                          <!-- The user image in the navbar-->
                                          <img src="{{ Auth::user()->profile_picture_url }}" class="user-image" alt="User Image">
                                          <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                          <span class="hidden-xs">{{ ucwords(Auth::user()->name) }}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                          <!-- The user image in the menu -->
                                          <li class="user-header">
                                                <img src="{{ Auth::user()->profile_picture_url }}" class="img-circle" alt="User Image">

                                                <p>
                                                      {{ ucwords(Auth::user()->name) }} - {{ ucfirst(Auth::user()->role) }}
                                                      <small>{{ Auth::user()->email }}</small>
                                                </p>
                                          </li>
                                          <!-- Menu Footer-->
                                          <li class="user-footer">
                                                <div class="pull-left">
                                                      <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                                                </div>
                                                <div class="pull-right">
                                                    <!-- Authentication -->
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                        <a href="{{ route('logout') }}"

                                           onclick="event.preventDefault(); this.closest('form').submit();"

                                           class="btn btn-default btn-flat">Sign out</a>
                                                    </form>

                                                </div>
                                          </li>
                                    </ul>
                              </li>
                        </ul>
                  </div>
            </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      @include('admin.partials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('content')
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
      @include('admin.partials.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('backend/plugins/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('backend/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('backend/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('backend/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/plugins/fastclick/lib/fastclick.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/sumoselect/jquery.sumoselect.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/js/adminlte.min.js') }}"></script>
<script src="{{ asset('backend/js/general.js') }}"></script>
@stack('scripts')
</body>
</html>
