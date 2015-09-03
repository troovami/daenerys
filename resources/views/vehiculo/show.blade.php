@extends('template.app')
@section('page', $page_title)
@section('padre', 'Marcas')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<p class="text-center"><img class="img-rounded" style="width:230px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" /></p>
  			<h2 class="text-center">&laquo; {{$marca->str_marca}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> {{$page_title}} Marca </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Marca:</th>
		  			<td>{{$marca->str_marca}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Friendly URL:</th>
		  			<td>{{$marca->str_friendly_url}}</td>
		  			</tr>
		  			<tr>		  			
		  			<tr>
		  			<th class="text-right">URL Web:</th>
		  			<td>{{$marca->str_website}}</td>
		  			</tr>
		  			@if ($tipos != FALSE)
		  			<tr>		  			
		  			<th class="text-right">Tipo(s):</th>
		  			<td>
		  				@for ($i = 0; $i < count($tipos); $i++)
		  					<span class="label label-primary">{{$tipos[$i]->str_descripcion}}</span>
		  				@endfor 
		  			</td>
		  			</tr>
		  			@endif
		  			<tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($marca->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			</tr>
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('marca.edit',$marca->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('marca.status',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('marca.delete',$marca->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
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