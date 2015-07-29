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
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-certificate text-success"></i> {{$page_title}} "Estado" Persona </h3>
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
            <tr>                      
              <th class="text-right">Certificado:</th>
              @if ($persona->bol_certificado == false)
                <td><span class="label label-default"><i class="fa fa-certificate"></i> NO CERTIFICADO</span></td>
              @else
                <td><span class="label label-primary"><i class="fa fa-certificate"></i> CERTIFICADO</span></td>
              @endif
            </tr> 
		  			<tr>            
              <th class="text-right">Cambiar Estado:</th>
              <td>
                {!! Form::model($persona,['route'=>['persona.certificate',$persona->id],'method'=>'PUT']) !!}
                    <div class="input-group col-md-12">
                            {!! Form::select('bol_certificado',
                                      ([
                                        'Seleccione' => 'Seleccione',
                                        '1'=>'Certificar',
                                        '0'=>'No Certificar'
                                      ]), 
                                                    null, 
                                                    [
                                                      'class' => 'form-control'
                                                    ]
                                                )!!} 
                          <span class="input-group-btn">
                            {!! Form::button('<i class="fa fa-certificate"></i> Cambiar Estado Certificado', array('class'=>'btn bg-success btn-flat', 'type'=>'submit')) !!}                                                  
                          </span>
                          </div><!-- /input-group -->             
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