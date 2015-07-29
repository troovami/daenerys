@extends('template.app')
@section('page', $page_title)
@section('padre', 'Marcas')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<p class="text-center"><img class="img-rounded" style="width:230px;" src="data:{{$marca[0]->format}};base64,{{$marca[0]->blb_img}}" /></p>
  			<h2 class="text-center">&laquo; {{$marca[0]->str_marca}} &raquo;</h2>
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
		  			<td>{{$marca[0]->str_marca}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Friendly URL:</th>
		  			<td>{{$marca[0]->str_friendly_url}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Meta Descripcion:</th>
		  			<td>{{$marca[0]->str_meta_descripcion}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Meta Keyword:</th>
		  			<td>{{$marca[0]->str_meta_keyword}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">URL Web:</th>
		  			<td>{{$marca[0]->str_website}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Tipo:</th>
		  			<td>{{$marca[0]->str_descripcion}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($marca[0]->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			</tr>
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('marca.edit',$marca[0]->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('marca.status',$marca[0]->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('marca.delete',$marca[0]->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
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