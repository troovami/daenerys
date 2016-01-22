@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<section class="content col-md-6 col-md-push-3">
			@if (count($errors) > 0)
    		    <div class="alert alert-danger">
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
              {{Session::get('message')}}
            </div>        
    		@endif      
          <div class="row">
          	<div class="col-md-4">
  			@if ($user->bol_eliminado == 0)
		  		    <p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/troovami-logo-online.png') }}" alt="..."></p>
		  	   @else
		  		    <p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/troovami-logo-offline.png') }}" alt="..."></p>
		  	   @endif
  			<h2 class="text-center">&laquo; {{$user->name}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-shield text-primary"></i> {{$page_title}} Administrador </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Usuario:</th>
		  			<td>{{$user->name}}</td>
		  			
		  			
		  			</tr>
		  			<tr>
		  				<th class="text-right">Nombre Completo:</th>
		  				<td>{{$user->str_nombre}}, {{$user->str_apellido}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Correo:</th>
		  				<td>{{$user->email}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Teléfono:</th>
		  				<td>{{$user->str_telefono}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Fecha de Creación:</th>
		  				<td>{{$user->created_at}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Rol:</th>
		  				<td>{{$rol}}</td>
		  			</tr>
		  			</tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($user->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			<tr>
		  			<tr>
		  				@if ($user->password == '')
		  				<td colspan="2">		  		    		
        				{!! Form::model($user,['route'=>['admin.generate',$user->id],'method'=>'PUT']) !!}
        					{!! Form::hidden('bol_eliminado', '1') !!}
        					<div class="form-group col-md-5">
        					{!! Form::password('password', ['class'=> 'form-control','placeholder'=>'Contraseña']) !!}
        					</div>
		                    <div class="input-group col-md-7">		                    
                            

                        	{!! Form::password('password_confirmation', ['class'=> 'form-control','placeholder'=>'Confirmar Contraseña']) !!}                        
		                            
		                          <span class="input-group-btn">
		                          	{!! Form::button('<i class="fa fa-shield"></i> Generar', array('class'=>'btn btn-primary btn-flat', 'type'=>'submit')) !!}
		                                                  
		                          </span>
		                    </div><!-- /input-group -->             
                 		{!! Form::close() !!}
		  	   
		  		    	</td>
		  				@else	  				
		  				
		  		    	<th class="text-right">No se puede Generar:</th>
		  				<td>
		  					<span class="label label-success"><i class="fa fa-shield"></i> ESTA CUENTA POSEE PASSWORD</span>
		  					<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> DEBE RESETEAR EL PASSWORD PARA PODER GENERARLO</span>

		  				</td>
		  	   			@endif
		  					
					</tr>
		  			
		  			</tbody>			  		
                  </table>                  
                </div>
              </div>
            </div>  
          </div>  

@endsection