@extends('template.app2')

@section('content')

<div class="login-box">
      <div class="login-logo">
      	@if ($user->bol_eliminado == FALSE)
        <a href="#">
        <p class="text-center"><img style="width:90px;" class="" src="{{ asset('images/troovami-logo-online.png') }}" alt="..."></p>
        <b>Generar </b> Password</a>
		@else
		<a href="#">
    <p class="text-center"><img style="width:90px;" class="" src="{{ asset('images/troovami-logo-online.png') }}" alt="..."></p>
    <b>Admin</b> Troovami</a>
		@endif  			
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
	  @if(Session::has('message'))

            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-shield"></i>  {{Session::get('message')}}
            </div> 

    @endif 
             
      <div class="login-box-body">
      	 @if ($user->bol_eliminado == FALSE)
         <p class="login-box-msg">&laquo;{{$user->name}}&raquo; {{$user->str_nombre}}, {{$user->str_apellido}}</p>  
        {!! Form::model($user,['route'=>['pass.generate',$user->id],'method'=>'PUT', 'class' => 'form']) !!}          
        
                            
                            <div class="form-group has-feedback">  
                            	<label class="">{{ trans('validation.attributes.password') }}</label>

                                {!! Form::password('password', ['class'=> 'form-control','placeholder' => "Contraseña"]) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">  
                            	<label class="">Confirmar Password</label>
                            	                             
                                {!! Form::password('password_confirmation', ['class'=> 'form-control','placeholder'=>'Confirmar Contraseña']) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">                                
                                <div class="col-xs-4">                                  
                                  {!! Form::button('<i class="fa fa-shield"></i> Generar Password', array('class'=>'btn btn-primary btn-flat', 'type'=>'submit')) !!}                                 
                                </div><!-- /.col -->
                              </div>                           
         {!! Form::close() !!}
         @else
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
        

        <a href="{{route('pass.lost')}}">Olvidé mi Contraseña</a><br>
		 @endif
       </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection

