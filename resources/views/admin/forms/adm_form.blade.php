                        <div class="form-group col-md-3">
                            <label>Usuario</label>
                            {!! Form::input('text', 'name', null, ['class'=> 'form-control']) !!}

                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Nombre</label>
                            {!! Form::input('text', 'str_nombre', null, ['class'=> 'form-control']) !!}
                        </div>
                                                
                        <div class="form-group col-md-3">
                            <label>Apellido</label>
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
                        
                     	<div class="form-group col-md-3">
                            <label>Cédula</label>
                            {!! Form::input('text', 'str_cedula', null, ['class'=> 'form-control']) !!}
                        </div>                                              
                        
                        

                        <div class="form-group col-md-3">
                            <label>Correo</label>
                            {!! Form::email('email', null, ['class'=> 'form-control']) !!}
                        </div>
                        
                        
                        <div class="form-group col-md-3">
                            <label>Rol</label>
                            
                            {!! Form::select('lng_idrol', 
                                                (['' => 'Seleccione'] + $roles), 
                                                null, 
                                                ['class' => 'form-control']
                                            ) 
                            !!} 
                            
                        </div> 

                        <div class="form-group col-md-3">
                            <label>Teléfono</label>
                            {!! Form::input('text', 'str_telefono', null, ['class'=> 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Imagen de Perfil</label><br>
                            <span class="btn btn-default btn-file col-md-12">
                            <i class="fa fa-image"></i> Imagen de Perfil...{!! Form::file('blb_img') !!}    
                            </span>                        
                        </div>                     
                        
                        <div class="form-group col-md-3">
                            <label>Contraseña</label>
                            {!! Form::password('password', ['class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group col-md-3">
                            <label>Confirmacion de Contraseña</label>
                            {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
                        </div>
                            {!! Form::input('hidden', 'lng_idservicio','3') !!}