@extends('template.app')
@section('page', $page_title)
@section('padre', 'Personas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                @if($persona->blb_img=="")
                    <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i> {{$page_title}} Persona &laquo; {{$persona->name}} &raquo; <small>{{$persona->str_nombre}}, {{$persona->str_apellido}}</small></h3>
                @else
                    <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i> {{$page_title}} Persona &laquo; {{$persona->name}} &raquo; <img class="img-circle" style="width:30px;" src="data:{{$persona->format}};base64,{{$persona->blb_img}}" /> <small>{{$persona->str_nombre}}, {{$persona->str_apellido}}</small></h3>
                @endif
                   
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                {!! Form::model($persona,['route'=>['persona.update',$persona->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group col-md-3">
                            <label>Usuario</label>
                            {!! Form::input('text', 'name', null, ['class'=> 'form-control']) !!}

                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Nombre(s)</label>
                            {!! Form::input('text', 'str_nombre', null, ['class'=> 'form-control']) !!}
                        </div>
                                                
                        <div class="form-group col-md-3">
                            <label>Apellido(s)</label>
                            {!! Form::input('text', 'str_apellido', null, ['class'=> 'form-control']) !!}
                        </div> 

                        <div class="form-group col-md-3">
                            <label>Genero</label>
                            
                            {!! Form::select('lng_idgenero', 
                                                (['' => 'Seleccione'] + $generos), 
                                                null, 
                                                ['class' => 'form-control']
                                            ) 
                            !!}                             
                        </div>

                        <!-- Date range -->
                  <div class="form-group col-md-3">                  
                    <label>Fecha de Nacimiento</label>
                    <div class="input-group-btn">                        
                        <span class="input-group-btn">
                            {!! Form::select('dia', 
                                (['' => '- Dia -'] + $dias), 
                                null, 
                                ['class' => 'form-control']
                                ) 
                            !!}                            
                        </span>
                        <span class="input-group-btn">
                            {!! Form::select('mes', 
                                (['' => '- Mes -'] + $meses), 
                                null, 
                                ['class' => 'form-control']
                                ) 
                            !!}
                        </span>
                        <span class="input-group-btn">
                            {!! Form::select('anio', 
                                (['' => '- Año -'] + $anios), 
                                null, 
                                ['class' => 'form-control']
                                ) 
                            !!}
                        </span>                          
                    </div>                    
                  </div><!-- /.form group -->

                        <div class="form-group col-md-3">
                            <label>Documento de Identificacion</label>
                            {!! Form::input('text', 'str_ididentificacion', null, ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label>Pasaporte</label>
                            {!! Form::input('text', 'str_pasaporte', null, ['class'=> 'form-control']) !!}
                        </div>                          
                        <div class="form-group col-md-3">
                            <label>Pais de Residencia</label>
                            
                            {!! Form::select('lng_idpais', 
                                                (['' => 'Seleccione'] + $paises), 
                                                null, 
                                                ['class' => 'form-control']
                                            ) 
                            !!} 
                            
                        </div> 
                        <!-- Field -->
                        <div class="form-group col-md-3">
                        @if($persona->blb_img=="")
                        <label>Imagen de Perfil</label><br>                            
                        @else
                        <label data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Imagen de Perfil <i class="fa fa-image text-yellow"></i></label><br>                        
                              <span style="margin-top:-40px; background:#fff;" class="dropdown-menu">
                                <p class="text-center">
                                <img class="img-rounded" style="width:140px;" src="data:{{$persona->format}};base64,{{$persona->blb_img}}" />
                                </p>
                              </span>
                        @endif    
                            <span class="btn btn-default btn-file col-md-12">
                            <i class="fa fa-image"></i> Imagen de Perfil...{!! Form::file('blb_img') !!}    
                            </span>                        
                        </div> 
                        <!-- End Field -->
                        <div class="form-group col-md-3">
                            <label>Correo</label>
                            {!! Form::email('email', null, ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label>Teléfono</label>
                            {!! Form::input('text', 'str_telefono', null, ['class'=> 'form-control']) !!}
                        </div>
                        
                        <!--<div class="form-group col-md-3">
                            <label>Rol</label>
                            
                            {!! Form::select('lng_idrol', 
                                                (['' => 'Seleccione'] + $roles), 
                                                null, 
                                                ['class' => 'form-control']
                                            ) 
                            !!} 
                            
                        </div>--> 
                        
                        <div class="form-group col-md-3">
                            <label>Twitter <i class="fa fa-twitter"></i></label>
                            {!! Form::input('text', 'str_twitter', null, ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label>Facebook <i class="fa fa-facebook"></i></label>
                            {!! Form::input('text', 'str_facebook', null, ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label>Instagram <i class="fa fa-instagram"></i></label>
                            {!! Form::input('text', 'str_instagram', null, ['class'=> 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-md-3">
                            <br>
                            {!! Form::button('<i class="fa fa-pencil"></i> Editar', array('class'=>'btn btn-warning btn-block', 'type'=>'submit')) !!}
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