@extends('template.app')
@section('page', $page_title)
@section('padre', 'Operadora')
@section('content')


@foreach ($operpais as $oper)
@endforeach

<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
            <p class="text-center"><img style="width: 35px; height: 35px" src="data:image/jpeg;base64,{{ $oper->logo }}" alt="" title=""></p>
        <h2 class="text-center">&laquo; {{$oper->str_operadora}} &raquo;</h2>
        </div>
            <div class="col-md-8">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search text-aqua"></i> Operadora</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Operadora:</th>
		  			<td>{{$oper->str_operadora}}</td>
		  			</tr>
            <tr>
            <th class="text-right">País:</th>
            <td>
            @foreach ($operpais as $oper)
            {{$oper->str_paises}}
            @endforeach
            </td>
            </tr>
            <tr>
		  				<th class="text-right">Acciones:</th>
		  				<td>
		  					<div class="btn-group">
			                    <a class="btn btn-warning btn-flat" href="{{route('redes.edit_operadora',$oper->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>	
			                    <a class="btn bg-purple btn-flat" href="{{route('redes.status_operadora',$oper->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                    <a class="btn btn-danger btn-flat" href="{{route('redes.delete_operadora',$oper->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
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