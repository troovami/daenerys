@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<section class="content col-md-6 col-md-push-3">
			@if(Session::has('message'))

            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <i class="fa fa-eraser"></i>
              {{Session::get('message')}}
            </div>  
            @endif      
          <div class="row">
          	<div class="col-md-4">
  			@if($user->blb_img=="" and $user->lng_idgenero == 1)
          	<p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/user_masculino.png') }}" /></p>
          	@elseif($user->blb_img=="" and $user->lng_idgenero == 2)
          	<p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/usuario_femenino.png') }}" /></p>
          	@else
          	<p class="text-center"><img class="img-circle img-responsive" src="data:{{$user->format}};base64,{{$user->blb_img}}" /></p>
          	@endif
  			<h2 class="text-center">&laquo; {{$user->name}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-eraser"></i> {{$page_title}} Administrador </h3>
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
		  				<th class="text-right">Reset Generado:</th>
		  				<td><span class="label label-default"><i class="fa fa-eraser"></i> Password ya Reseteado</span></td>
		  				@else
		  				<th class="text-right">Accion:</th>
		  				<td>
		  		    	{!! Form::model($user,['route'=>['admin.reset',$user->id],'method'=>'PUT']) !!}	  				{!! Form::hidden('bol_eliminado', '1') !!}
		  						{!! Form::hidden('password', 'secret') !!}
        						{!! Form::button('<i class="fa fa-eraser"></i> Reset Password', array('class'=>'btn btn-default', 'type'=>'submit')) !!}                
        				{!! Form::close() !!}	
		  	   
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