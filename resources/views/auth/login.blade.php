@extends('template.app2')

@section('content')

<div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Admin</b> Troovami</a>
		  			
      </div><!-- /.login-logo -->
      @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Por favor corrige los siguientes errores:<br><br>
        <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
        </ul>
      </div>						
			@endif
      <div class="login-box-body">
        <p class="login-box-msg">Inicio de Sesión</p>        
        {!! Form::open(['route' => 'login', 'class' => 'form']) !!}
                            <div class="form-group has-feedback">  
                            	<label class="">{{ trans('validation.attributes.email') }}</label>                              
                                {!! Form::email('email', '', ['class'=> 'form-control', 'placeholder' => "Correo Electrónico"]) !!}
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">  
                            	<label class="">{{ trans('validation.attributes.password') }}</label>                             
                                {!! Form::password('password', ['class'=> 'form-control','placeholder' => "Contraseña"]) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                  <div class="checkbox icheck">
                                    <label>
                                      <input name="remember" type="checkbox"> Recordarme
                                    </label>
                                  </div>
                                </div><!-- /.col -->
                                <div class="col-xs-4">
                                  {!! Form::submit('Entrar',['class' => 'btn btn-primary btn-block btn-flat']) !!}                                  
                                </div><!-- /.col -->
                              </div>                           
         {!! Form::close() !!}
        

        <a href="#">Olvidé mi Contraseña</a><br>
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection