<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Troovami')</title>    
    <link rel="icon" href="{{ asset('images/daenerys.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    {!! Html::style('admin-lte/bootstrap/css/bootstrap.min.css') !!}    
    <!-- FontAwesome 4.3.0 -->    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme style -->    
    {!! Html::style('admin-lte/dist/css/AdminLTE.min.css') !!}    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('admin-lte/dist/css/skins/_all-skins.min.css') !!}    

    <!-- iCheck -->
    {!! Html::style('admin-lte/plugins/iCheck/flat/blue.css') !!}       
    <!-- Morris chart -->
    {!! Html::style('admin-lte/plugins/morris/morris.css') !!}    
    <!-- jvectormap -->
    {!! Html::style('admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}    
    <!-- Date Picker -->
    {!! Html::style('admin-lte/plugins/datepicker/datepicker3.css') !!}    
    <!-- Daterange picker -->
    {!! Html::style('admin-lte/plugins/daterangepicker/daterangepicker-bs3.css') !!}    
    <!-- bootstrap wysihtml5 - text editor -->
    {!! Html::style('admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head')
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
	    <!-- Menu Horizontal -->
      @include('template/header')
      <!-- Menu Vertical -->
      @include('template/menu')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('page', 'Dashboard')
            <small>@yield('padre', 'Control Panel')</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">@yield('page', 'Dashboard')</li>
          </ol>
        </section>
		@yield('content')
        
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version-beta</b> 0.1
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">Admin</a>.</strong> All rights reserved.
      </footer>

      <!-- Menu Control Sidebar Vertical Derecho -->
      @include('template/menu-control-sidebar')
    </div><!-- ./wrapper -->
    
    <!-- jQuery 2.1.4 -->
    {!! Html::script('admin-lte/plugins/jQuery/jQuery-2.1.4.min.js') !!}    
    <!-- jQuery UI 1.11.4 -->
    {!! Html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') !!}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    {!! Html::script('admin-lte/bootstrap/js/bootstrap.min.js') !!}   
    @yield('footer') 
    <!-- Morris.js charts -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') !!}
    {!! Html::script('admin-lte/plugins/morris/morris.min.js') !!}    
    <!-- Sparkline -->
    {!! Html::script('admin-lte/plugins/sparkline/jquery.sparkline.min.js') !!}    
    <!-- jvectormap -->
    {!! Html::script('admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}    
    {!! Html::script('admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}    
    <!-- jQuery Knob Chart -->
    {!! Html::script('admin-lte/plugins/knob/jquery.knob.js') !!}    
    <!-- daterangepicker -->
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') !!} 
    {!! Html::script('admin-lte/plugins/daterangepicker/daterangepicker.js') !!}    
    <!-- datepicker -->
    {!! Html::script('admin-lte/plugins/datepicker/bootstrap-datepicker.js') !!}    
    <!-- Bootstrap WYSIHTML5 -->
    {!! Html::script('admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}    
    <!-- Slimscroll -->
    {!! Html::script('admin-lte/plugins/slimScroll/jquery.slimscroll.min.js') !!}    
    <!-- FastClick -->
    {!! Html::script('admin-lte/plugins/fastclick/fastclick.min.js') !!}    
    <!-- AdminLTE App -->
    {!! Html::script('admin-lte/dist/js/app.min.js') !!}    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {!! Html::script('admin-lte/dist/js/pages/dashboard.js') !!}    
    <!-- AdminLTE for demo purposes -->
    {!! Html::script('admin-lte/dist/js/demo.js') !!} 

  </body>
</html>
