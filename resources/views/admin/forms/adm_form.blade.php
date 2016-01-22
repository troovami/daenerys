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
                        
                        <div class="form-group col-md-4">
                            <label>Contraseña</label>
                            {!! Form::password('password', ['class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label>Confirmacion de Contraseña</label>
                            {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
                        </div>
                            {!! Form::input('hidden', 'lng_idservicio','3') !!}