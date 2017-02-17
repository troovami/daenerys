@extends('template.app')
@section('page', $page_title)
@section('padre', 'Operadora')
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
          	<div class="col-md-6">
             <p class="text-center"><img style="width: 35px; height: 35px" src="data:image/jpeg;base64,{{ $operadora->blb_img }}" alt="" title=""></p>
  			    <h2 class="text-center">&laquo; {{$operadora->str_operadora}} &raquo;</h2>
  			</div>
            <div class="col-md-6">
              <div class="box box-purple">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-ban"></i> Tecnología</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  	<tbody>
		  			<tr>
            <th class="text-right">Nombre de la Operadora:</th>
            <td>{{$operadora->str_operadora}}</td>
            </tr>
            <tr>
              <th class="text-right">Estado:</th>
              @if ($operadora->bol_eliminado == 0)
                <td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
              @else
                <td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
              @endif
            </tr>
		  			<tr>
              <td colspan="2">
                {!! Form::model($operadora,['route'=>['redes.status_operadora',$operadora->id],'method'=>'PUT']) !!}
                    <div class="input-group col-md-12">
                            {!! Form::select('bol_eliminado',
                                      ([
                                        'Seleccione' => 'Seleccione',
                                        '0'=>'Activar',
                                        '1'=>'Desactivar'
                                      ]), 
                                                    null, 
                                                    [
                                                      'class' => 'form-control'
                                                    ]
                                                )!!} 
                          <span class="input-group-btn">
                            {!! Form::button('<i class="fa fa-ban"></i> Cambiar Estado', array('class'=>'btn bg-purple btn-flat', 'type'=>'submit')) !!}                                                  
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