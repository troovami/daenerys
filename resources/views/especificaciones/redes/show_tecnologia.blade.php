@extends('template.app')
@section('page', $page_title)
@section('padre', 'Tecnología')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<h2 class="text-center">&laquo; {{$tecnologia->str_especificaciones}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> Tecnología</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Tecnología:</th>
		  			<td>{{$tecnologia->str_especificaciones}}</td>
		  			</tr>
            <tr>
            <th class="text-right">Descripción:</th>
            <td>{{$tecnologia->str_description}}</td>
            </tr>
		  			
		  			<tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('redes.edit_tecnologia',$tecnologia->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('redes.status_tecnologia',$tecnologia->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('redes.delete_tecnologia',$tecnologia->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
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