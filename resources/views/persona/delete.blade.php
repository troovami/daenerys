@extends('template.app')
@section('page', $page_title)
@section('padre', 'Personas')
@section('content')
<section class="content col-md-6 col-md-push-3">
          <div class="row">
          	<div class="col-md-4">
  			@if ($persona->blb_img == "")
              @if ($persona->bol_eliminado == 0)
  		  		    <p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/troovami-logo-online.png') }}" alt="..."></p>
  		  	     @else
  		  		    <p class="text-center"><img class="img-circle img-responsive" src="{{ asset('images/troovami-logo-offline.png') }}" alt="..."></p>
  		  	     @endif
          @else
                <p class="text-center"><img class="img-circle img-responsive" style="width:230px;" src="data:{{$persona->format}};base64,{{$persona->blb_img}}" /></p>
          @endif
  			<h2 class="text-center">&laquo; {{$persona->name}} &raquo;</h2>
  			</div>
            <div class="col-md-8">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-user-times text-red"></i> {{$page_title}} Persona </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
		  			<th class="text-right">Usuario:</th>
		  			<td>{{$persona->name}}</td>
		  			
		  			
		  			</tr>
		  			<tr>
		  				<th class="text-right">Nombre Completo:</th>
		  				<td>{{$persona->str_nombre}}, {{$persona->str_apellido}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Correo:</th>
		  				<td>{{$persona->email}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Teléfono:</th>
		  				<td>{{$persona->str_telefono}}</td>
		  			</tr>
		  			<tr>
		  				<th class="text-right">Fecha de Creación:</th>
		  				<td>{{$persona->created_at}}</td>
		  			</tr>
		  			<tr>		  					  			
		  				<th class="text-right">Estado:</th>
		  				@if ($persona->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif		  			
		  			</tr>	
		  			<tr>		  			
		  				<th class="text-right">Certificado:</th>		  				
		  				<td>
		  					@if ($persona->bol_certificado == NULL)		  				
		  					<span class="label label-default"><i class="fa fa-certificate"></i> NO CERTIFICADO</span>
		  					@else
		  					<span class="label label-primary"><i class="fa fa-certificate"></i> CERTIFICADO</span>
		  					@endif
		  				</td>
		  			</tr>	  			
		  			<tr>
		  				<th class="text-right">Accion:</th>
		  				<td>
		  					{!! Form::open(['route'=>['persona.destroy',$persona->id],'method'=>'DELETE']) !!}    {!!Form::button('<i class="fa fa-user-times"></i> Eliminar Persona', array('class'=>'btn btn-danger btn-block', 'type'=>'submit')) !!}     
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