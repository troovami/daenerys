@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
          	@if($user[0]->blb_img=="" and $user[0]->lng_idgenero == 1)
          	<p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/user_masculino.png') }}" /></p>
          	@elseif($user[0]->blb_img=="" and $user[0]->lng_idgenero == 2)
          	<p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/usuario_femenino.png') }}" /></p>
          	@else
          	<p class="text-center"><img class="img-circle img-responsive" src="data:{{$user[0]->format}};base64,{{$user[0]->blb_img}}" /></p>
          	@endif
		 
  			
  			<h2 class="text-center">&laquo; {{$user[0]->name}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> {{$page_title}} del Administrador </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Usuario:</th>
		  			<td>{{$user[0]->name}}</td>
		  			
		  			
		  			</tr>
		  			<tr>
		  				<th class="text-right">Nombre Completo:</th>
		  				<td>{{$user[0]->str_nombre}}, {{$user[0]->str_apellido}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Correo:</th>
		  				<td>{{$user[0]->email}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Teléfono:</th>
		  				<td>{{$user[0]->str_telefono}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Fecha de Creación:</th>
		  				<td>{{$user[0]->created_at}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Rol:</th>
		  				<td>{{$user[0]->str_rol}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('admin.edit',$user[0]->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('admin.status',$user[0]->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('admin.delete',$user[0]->id)}}" title="Eliminar"><i class="fa fa-user-times"></i></a>
			                    <a class="btn btn-default btn-flat" href="{{route('admin.reset',$user[0]->id)}}" title="Resetar Password"><i class="fa fa-eraser"></i></a>
			                    <a class="btn btn-primary btn-flat" href="{{route('admin.generate',$user[0]->id)}}" title="Generar Password"><i class="fa fa-shield"></i></a>
			                </div>
		  				</td>
		  			</tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($user[0]->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			<tr>
		  			</tr>	  			
		  			   		  			
		  			</tbody>			  		
                  </table>                  
                </div>
              </div>
            </div>  
          </div>  

@endsection