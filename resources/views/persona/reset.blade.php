@extends('template.app')
@section('page', $page_title)
@section('padre', 'Personas')
@section('content')
<section class="content col-md-6 col-md-push-3">
          @if (count($errors) > 0)
    		    <div class="alert alert-danger">
    		        <ul>
    		            @foreach ($errors->all() as $error)
    		                <li>{{ $error }}</li>
    		            @endforeach
    		        </ul>
    		    </div>
    		@endif		    
          

		  @if(Session::has('message'))

            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    	  @endif
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
              <div class="box box-purple">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-ban"></i> {{$page_title}} de la Persona &laquo; {{$persona->name}} &raquo;</h3>
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
		  				<th class="text-right">Fecha de Creación:</th>
		  				<td>{{$persona->created_at}}</td>
		  			</tr>		  					  			
		  				<th class="text-right">Estado:</th>
		  				@if ($persona->bol_eliminado == 0)
		  					<td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
		  				@else
		  					<td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
		  				@endif		  			
		  			<tr>
              @if ($persona->password == '')
              <th class="text-right">Reset Generado:</th>
              <td><span class="label label-default"><i class="fa fa-eraser"></i> Password ya Reseteado</span></td>
              @else
              <th class="text-right">Accion:</th>
              <td>
                {!! Form::model($persona,['route'=>['persona.reset',$persona->id],'method'=>'PUT']) !!}           {!! Form::hidden('bol_eliminado', '1') !!}
                  {!! Form::hidden('password', 'secret') !!}
                    {!! Form::button('<i class="fa fa-eraser"></i> Reset Password', array('class'=>'btn btn-default', 'type'=>'submit')) !!}                
                {!! Form::close() !!} 
           
                </td>
                @endif
                
          </tr>
		  			   		  			
		  			</tbody>			  		
                  </table>                  
                </div>
              </div>
            </div>  
          </div>  

@endsection