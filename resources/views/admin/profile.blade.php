@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			<p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/troovami-logo-online.png') }}" alt="..."></p>
  			<h2 class="text-center">&laquo; {{Auth::user()->name}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-user-secret"></i> {{$page_title}} del Administrador </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Usuario:</th>
		  			<td>{{Auth::user()->name}}</td>
		  			
		  			
		  			</tr>
		  			<tr>
		  				<th class="text-right">Nombre Completo:</th>
		  				<td>{{Auth::user()->str_nombre}}, {{Auth::user()->str_apellido}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Correo:</th>
		  				<td>{{Auth::user()->email}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Teléfono:</th>
		  				<td>{{Auth::user()->str_telefono}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Fecha de Creación:</th>
		  				<td>{{Auth::user()->created_at}}</td>
		  			</tr>
		  			</tbody>			  		
                  </table>
                </div>
              </div>
            </div>  
          </div>  

@endsection