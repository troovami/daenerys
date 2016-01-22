@extends('template.app')
@section('page', $page_title)
@section('padre', 'Paises')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<p class="text-center"><img class="img-rounded" style="width:230px;" src="data:{{$pais->format}};base64,{{$pais->blb_img}}" /></p>
  			<h2 class="text-center">&laquo; {{$pais->str_paises}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> {{$page_title}} Pais </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">País:</th>
		  			<td>{{$pais->str_paises}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Estado:</th>
		  				@if ($pais->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif
		  			</tr>
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('pais.edit',$pais->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('pais.status',$pais->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>			                    
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