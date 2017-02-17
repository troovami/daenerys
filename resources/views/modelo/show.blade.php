@extends('template.app')
@section('page', $page_title)
@section('padre', 'Modelo')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<h2 class="text-center">&laquo; {{$modelo->str_modelo}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> {{$page_title}} Modelo </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Marca:</th>
		  			<td>{{$marca->str_marca}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Modelo:</th>
		  			<td>{{$modelo->str_modelo}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Clasificación:</th>
		  			<td>{{$clasificacion->str_descripcion}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Gama:</th>
		  			<td>{{$gama->str_descripcion}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($modelo->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			</tr>
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('modelo.edit',$modelo->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('modelo.status',$modelo->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('modelo.delete',$modelo->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
			                </div>
		  				</td>
		  			</tr>
		  			</tbody>			  		
                  </table>                  
                </div>
              </div>
            </div>  
          </div>  

@endsection