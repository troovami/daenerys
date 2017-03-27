@extends('template.app')
@section('page', $page_title)
@section('padre', 'Noticia')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<h2 class="text-center">&laquo; {{$noticia->str_titulo}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> {{$page_title}} Noticia </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Titulo:</th>
		  			<td>{{$noticia->str_titulo}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Contenido:</th>
		  			<td>{{$contenido}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">País:</th>
		  			<td>{{$noticiaPais[0]->pais}}</td>
		  			</tr>
		  			<tr>
		  			<th class="text-right">Letra:</th>
		  			<td>{{$noticiaVoc[0]->vocabulario}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($noticia->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			</tr>
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('noticia.edit',$noticia->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('noticia.status',$noticia->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>			                    
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