@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/lena-headey.png') }}" alt="..."></p>
  			<h2 class="text-center">&laquo; {{$user->name}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-user-secret"></i> {{$page_title}} Administrador </h3>
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
		  			<tr>
		  				<th class="text-right">Accion:</th>
		  				<td>
		  					{!! Form::open(['route'=>['admin.destroy',$user->id],'method'=>'DELETE']) !!}        	 
        						{!! Form::submit('Eliminar Administrador',['class'=>'btn btn-danger']) !!}                  
        					{!! Form::close() !!}
		  				</td>
		  			</tr>
		  			
		  			</tbody>			  		
                  </table>                  
                </div>
              </div>
            </div>  
          </div>  

@endsection