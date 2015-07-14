@extends('template.app2')
@section('content')

<div class="login-box">
      <div class="login-logo">
      	
        <a href="#"><b>Recuperación</b> Password</a>
				
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
          	 
        @if($mensaje['msn']=="")
        {!! Form::open(['route' => 'pass.lost', 'class' => 'form']) !!}
        
                            <div class="form-group has-feedback">  
                              <label class="">{{ trans('validation.attributes.email') }}</label>                              
                                {!! Form::email('email', '', ['class'=> 'form-control', 'placeholder' => "Correo Electrónico"]) !!}
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            
                            <div class="row">                                
                                <div class="col-xs-12">
                                  {!! Form::submit('Reestablecer Password',['class' => 'btn btn-primary btn-block btn-flat']) !!}                                  
                                </div><!-- /.col -->
                              </div>                           
         {!! Form::close() !!}
         @elseif($mensaje['bol_eliminado']==TRUE)
          <p><i class="fa fa-user-secret text-warning"></i> La Cuenta <b>{{$mensaje['email']}}</b> ha sido desactivada</p>
          <a class="btn btn-primary btn-block btn-flat" href="{{route('login')}}">Ir a la Principal</a>
         @else
          <p><i class="glyphicon glyphicon-envelope"></i> Se le ha enviado un correo electronico a la dirección  <b>{{$mensaje['email']}}</b> con los pasos a seguir para la reestablecer un nuevo Password.</p>
          <a class="btn btn-primary btn-block btn-flat" href="{{route('pass.generate',$mensaje['id'])}}">Reestablecer Password</a>
         @endif
	
       </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection

