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
    <!-- Font Awesome Icons -->
    {!! Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') !!}
    <!-- Theme style -->
    {!! Html::style('admin-lte/dist/css/AdminLTE.min.css') !!}
    <!-- iCheck -->
    {!! Html::style('admin-lte/plugins/iCheck/square/blue.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
  
  @yield('content')    

    <!-- jQuery 2.1.4 -->
    {!! Html::script('admin-lte/plugins/jQuery/jQuery-2.1.4.min.js') !!}    
    <!-- Bootstrap 3.3.2 JS -->
    {!! Html::script('admin-lte/bootstrap/js/bootstrap.min.js') !!}    
    <!-- iCheck -->
    {!! Html::script('admin-lte/plugins/iCheck/icheck.min.js') !!}    
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>