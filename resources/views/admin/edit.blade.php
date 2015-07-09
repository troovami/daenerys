@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i> {{$page_title}} Administrador &laquo; {{$user->name}} &raquo; <small>{{$user->str_nombre}}, {{$user->str_apellido}}</small></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                {!! Form::model($user,['route'=>['admin.update',$user->id],'method'=>'PUT']) !!}
        			<div class="form-group col-md-4">
                            <label>Usuario</label>
                            {!! Form::input('text', 'name', null, ['class'=> 'form-control']) !!}

                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Nombre</label>
                            {!! Form::input('text', 'str_nombre', null, ['class'=> 'form-control']) !!}
                        </div>
                                                
                        <div class="form-group col-md-4">
                            <label>Apellido</label>
                            {!! Form::input('text', 'str_apellido', null, ['class'=> 'form-control']) !!}
                        </div>                               
                        
                        
                        <div class="form-group col-md-4">
                            <label>Cédula</label>
                            {!! Form::input('text', 'str_cedula', null, ['class'=> 'form-control']) !!}
                        </div>                                              
                        

                        <div class="form-group col-md-4">
                            <label>Correo</label>
                            {!! Form::email('email', null, ['class'=> 'form-control']) !!}
                        </div>
                        
                        
                        <div class="form-group col-md-4">
                            <label>Rol</label>
                            
                            {!! Form::select('lng_idrol', 
                                                (['' => 'Seleccione'] + $roles), 
                                                null, 
                                                ['class' => 'form-control']
                                            ) 
                            !!} 
                            
                        </div> 

                        <div class="form-group col-md-4">
                            <label>Teléfono</label>
                            {!! Form::input('text', 'str_telefono', null, ['class'=> 'form-control']) !!}
                        </div>  
        			<div class="form-group col-md-4 col-md-push-4">
                    <br>
        			{!! Form::submit('Editar',['class'=>'btn btn-warning btn-block']) !!}                  
        			</div>
        		{!! Form::close() !!} 
        		              
                <!-- form end -->
                </div>
              </div><!-- /.box -->            
        </div>
        <!-- col-md-8 col-md-offset-2 -->
    </div>
    <!-- .row -->
</div>
@endsection
@endsection