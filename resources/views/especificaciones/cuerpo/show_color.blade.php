@extends('template.app')
@section('page', $page_title)
@section('padre', 'Color')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<h2 class="text-center">&laquo; {{$color->str_descripcion}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> Color </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Color:</th>
		  			<td>{{$color->str_descripcion}}</td>
            </tr>
            <tr>
            <th class="text-right">Codigo Hexadecimal:</th>
            <td>{{$color->str_caracteristica}}</td>
		  			</tr>
		  			
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('cuerpo.edit_color',$color->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('cuerpo.status_color',$color->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('cuerpo.delete_color',$color->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
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