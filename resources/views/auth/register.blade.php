@extends('template.app2')

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

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user-plus"></i> Registro de Usuarios</div>

                
				<div class="panel-body">
                    {!! Form::open(['route' => 'register', 'class' => 'form']) !!}                       
                        <div class="form-group col-md-4">
                            <label>Usuario</label>
                            {!! Form::input('text', 'name', '', ['class'=> 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Nombre</label>
                            {!! Form::input('text', 'str_nombre', '', ['class'=> 'form-control']) !!}
                        </div>
                                                
                        <div class="form-group col-md-4">
                            <label>Apellido</label>
                            {!! Form::input('text', 'str_apellido', '', ['class'=> 'form-control']) !!}
                        </div>                               
                        
                        
                        <div class="form-group col-md-4">
                            <label>Cédula</label>
                            {!! Form::input('text', 'str_cedula', '', ['class'=> 'form-control']) !!}
                        </div>                        						
                        

                        <div class="form-group col-md-4">
                            <label>Correo</label>
                            {!! Form::email('email', '', ['class'=> 'form-control']) !!}
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
                            {!! Form::input('text', 'str_telefono', '', ['class'=> 'form-control']) !!}
                        </div>                      
                        
                        <div class="form-group col-md-4">
                            <label>Contraseña</label>
                            {!! Form::password('password', ['class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label>Confirmacion de Contraseña</label>
                            {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
                        </div>
                            {!! Form::input('hidden', 'lng_idservicio','3') !!}

                        <div class="form-group col-md-4 col-md-push-8">
                            {!! Form::submit('Guardar',['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    {!! Form::close() !!}
                </div> 
                
                
                
            </div>
        </div>
    </div>
</div>
@endsection