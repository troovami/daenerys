@extends('template.app')
@section('page', $page_title)
@section('padre', 'Vehiculo')
@section('content')
<section class="content col-md-12">
          <div class="row">  
          	<div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-image"></i> Imagenes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    	@for ($i = 0; $i < count($imagenesVehiculo); $i++)	
                    		@if ($imagenesVehiculo[$i]->v_peso == 1)
                    			<li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="active"></li>
          							@else
          							    <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
          							@endif					    						    
          						@endfor                   
                    </ol>

                    <div class="carousel-inner">  
                    	
                    	@for ($j = 0; $j < count($imagenesVehiculo); $j++)
                    		@if ($imagenesVehiculo[$j]->v_peso == 1)
                    		<div class="item active">
	                        	<img src="{{$imagenesVehiculo[$j]->v_imagen}}" alt="Imagen Principal {{$imagenesVehiculo[$j]->v_peso}}">
		                        <div class="carousel-caption">
		                          <h3><span class="label label-primary">Imagen Principal {{$j}}</span></h3>
		                        </div>
                      		</div>
                    		@else
                    		<div class="item">
	                        	<img src="{{$imagenesVehiculo[$j]->v_imagen}}" alt="Imagen {{$imagenesVehiculo[$j]->v_peso}}">
		                        <div class="carousel-caption">
		                        	<h3><span class="label label-primary">Imagen {{$j}}</span></h3>                         
		                        </div>
                      		</div>
                    		@endif                    	                    		
                    	@endfor                   	              	                    	
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->       	
           	<div class="col-md-8">
              <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#tab_1-1" data-toggle="tab">Características</a></li>
                  <li class="active"><a href="#tab_2-2" data-toggle="tab">Descripciones</a></li>                  
                  <li><a href="#tab_3-2" data-toggle="tab">Datos Usuario</a></li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      Dropdown <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                  </li>
                  <li class="pull-left header"><i class="fa fa-car"></i>{{$vehiculo[0]->v_marca}} {{$vehiculo[0]->v_modelo}} {{$vehiculo[0]->v_anio}}</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" id="tab_1-1">                  
                    
              <div class="box box-solid">                
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Seguridad
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body">
                            <h4>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'seguridad_vehiculos')                            
                              <span class="label label-primary" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                            </h4>                          
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Sonido
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">                          
                          <h4>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'sonido_vehiculos')                            
                              <span class="label label-danger" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </h4>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Exterior
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">                          
                          <h4>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'exterior_vehiculos')                            
                              <span class="label label-success" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </h4>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-default">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Confort
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="box-body">                          
                          <h4>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'confort_vehiculos')                            
                              <span class="label label-default" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </h4>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-warning">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                            Accesorios Internos
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFive" class="panel-collapse collapse">
                        <div class="box-body">                          
                          <h4>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'accesoriosInternos_vehiculos')                            
                              <span class="label label-default" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane active" id="tab_2-2">
                    <table class="table table-bordered ">
                        <tr>
                          <th style="width: 16.5%" class="text-right">Tipo:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_tipo}}</td>
                          <th style="width: 16.5%" class="text-right">Clasificacion:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_clasificacion}}</td>
                          <th style="width: 16.5%" class="text-right">Marca:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_marca}}</td>                          
                        </tr>                                            
                        <tr>
                          <th style="width: 16.5%" class="text-right">País:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_pais}}</td>
                          <th style="width: 16.5%" class="text-right">Placa:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_placa}}</td>
                          <th style="width: 16.5%" class="text-right">Cilindrada:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_cilindrada}}</td>
                        </tr>
                        <tr>
                          <th style="width: 16.5%" class="text-right">Cilindros:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_cilindros}}</td>
                          <th style="width: 16.5%" class="text-right">Año:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_anio}}</td>
                          <th style="width: 16.5%" class="text-right">Arranque:</th>
                          @if ($vehiculo[0]->v_arranque == 0)  
                            <td style="width: 16.5%">No Aplica</td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_arranque}}</td>
                          @endif
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Direccion:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_direccion}}</td>
                          <th style="width: 16.5%" class="text-right">Estereo:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_estereo}}</td>
                          <th style="width: 16.5%" class="text-right">Transmision:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_transmision}}</td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Equipo Medico:</th>
                          @if ($vehiculo[0]->v_equipo_medico == 0)  
                            <td style="width: 16.5%">No Aplica</td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_equipo_medico}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Pisos:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_pisos}}</td>
                          <th style="width: 16.5%" class="text-right">Alto:</th>
                          @if ($vehiculo[0]->v_alto == 0)  
                            <td style="width: 16.5%">No Aplica</td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_alto}}</td>
                          @endif                           
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Ancho:</th>
                          @if ($vehiculo[0]->v_ancho == 0)  
                            <td style="width: 16.5%">No Aplica</td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_ancho}}</td>
                          @endif
                          <th style="width: 16.5%" class="text-right">Estereo:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_estereo}}</td>
                          <th style="width: 16.5%" class="text-right">Transmision:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_transmision}}</td>
                        </tr>
                        <!--            
           
            // Carroceria - Vehiculo
            'publicacion.str_carroceria as v_carroceria',
            // Frenado - Vehiculo
            'frenado.str_descripcion as v_frenado',
            // Frenado - Vehiculo 
            'publicacion.int_carga as v_carga',
            // Levantamiento - Vehiculo 
            'publicacion.int_levantamiento as v_levantamiento',
            // Lastre - Vehiculo 
            'publicacion.int_lastre as v_lastre',
            // Largo - Vehiculo 
            'publicacion.int_largo as v_largo',
            // Aceite - Vehiculo
            'aceite.str_descripcion as v_aceite',
            // Potencia Bruta - Vehiculo 
            'publicacion.int_potenciabruta as v_potencia_bruta',
            // Tambor - Vehiculo 
            'publicacion.str_tambor as v_tambor',
            // Produccion - Vehiculo 
            'publicacion.int_produccion as v_produccion',
            // Enfriamiento - Vehiculo
            'enfriamiento.str_descripcion as v_enfriamiento',
            // Neumatico - Vehiculo 
            'publicacion.dbl_neumatico as v_neumatico',
            // Potencia - Vehiculo 
            'publicacion.int_potencia as v_potencia',
            // Velocidades - Vehiculo 
            'publicacion.int_velocidades as v_velocidades',
            // Pasajeros - Vehiculo 
            'publicacion.int_pasajeros as v_pasajeros',
            // Horas uso - Vehiculo 
            'publicacion.int_horasuso as v_horas_uso',
            // Comentario - Vehiculo 
            'publicacion.str_comentario as v_comentario',
            // Negociable - Vehiculo 
            'negociable.str_descripcion as v_negociable',
            // Traccion - Vehiculo 
            'traccion.str_descripcion as v_traccion',
            // Tapizado - Vehiculo 
            'tapizado.str_descripcion as v_tapizado',
            // Motor Reparado - Vehiculo 
            'motor_reparado.str_descripcion as v_motor_reparado',
            // vidrios - Vehiculo 
            'vidrios.str_descripcion as v_vidrios',
            // Cantidad de Puertas - Vehiculo 
            'publicacion.int_cantidad_puertas as v_cantidad_puertas',
            // Color - Vehiculo 
            'color.str_descripcion as v_color',
            // Combustible - Vehiculo 
            'combustible.str_descripcion as v_combustible',
            // Unico Dueño - Vehiculo 
            'unico_dueno.str_descripcion as v_unico_dueno',
            // Recorrido - Vehiculo  
            'publicacion.str_recorrido as v_str_recorrido',
            // Version - Vehiculo  
            'publicacion.str_version as v_version',
            // Tipo de Motor - Vehiculo 
            'tipo_motor.str_descripcion as v_tipo_motor',
            // Financiamiento - Vehiculo 
            'financiamiento.str_descripcion as v_financiamiento',
            // Chocado - Vehiculo 
            'chocado.str_descripcion as v_chocado',
            // Recibo Moto - Vehiculo 
            'recibo_moto.str_descripcion as v_recibo_moto',
            // Sistema de Arranque - Vehiculo 
            'sistema_arranque.str_descripcion as v_sistema_arranque',
            // Fecha de Publicacion Fin - Vehiculo  
            'publicacion.dmt_fecha_publicacion_fin as v_fecha_publicacion_fin',
            // Fecha de Publicacion Inicio - Vehiculo  
            'publicacion.dmt_fecha_publicacion as v_fecha_publicacion_inicio',
            // bol_eliminado - Vehiculo  
            'publicacion.bol_eliminado as v_bol_eliminado',
            // bol_activa - Vehiculo  
            'publicacion.bol_activa as v_bol_activa',
            // esloralargo - Vehiculo  
            'publicacion.int_esloralargo as v_esloralargo',
            // Manga Ancho - Vehiculo  
            'publicacion.int_mangaancho as v_manga_ancho',
            // Maximo de Tripulantes - Vehiculo 
            'max_tripulantes.str_descripcion as v_max_tripulantes',
            // Material - Vehiculo 
            'material.str_descripcion as v_material',
            // Peso - Vehiculo  
            'publicacion.int_peso as v_peso',
            // Potencia maxima - Vehiculo  
            'publicacion.int_potenciamax as v_potencia_max',
            // Precio de Venta - Vehiculo  
            'publicacion.str_precio_venta as v_precio_venta',
            // Moneda - Vehiculo  
            'publicacion.str_moneda as v_moneda',
            // Ciudad - Vehiculo  
            'ciudad.str_ciudad as v_ciudad',         
            // Video - Vehiculo  
            'publicacion.str_video as v_video',            
            // updated_at - Vehiculo  
            'publicacion.updated_at as v_updated_at',            
            // created_at - Vehiculo              
            'publicacion.created_at as v_created_at',  
            // created_at - Vehiculo  
            'publicacion.status_admin as v_status_admin',
            // status_user - Vehiculo  
            'publicacion.status_user as v_status_user',
            // Baño - Vehiculo  
            'bano.str_descripcion as v_bano',
            // Ventana - Vehiculo  
            'ventana.str_descripcion as v_ventana'  
                        -->
                      </table>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-2">
                  <!-- table-striped -->
                    <div class="row">
                    <div class="col-md-2">
                      <p class="text-center">
                        <img style="width:100%;" src="data:{{$vehiculo[0]->formato_imagen_persona}};base64,{{$vehiculo[0]->imagen_persona}}" />
                      </p>                      
                    </div>
                    <div class="col-md-10">
                      <table class="table table-bordered ">
                        <tr>
                          <th style="width: 20%" class="text-right">Usuario:</th>
                          <td style="width: 30%">{{$vehiculo[0]->name}}</td>
                          <th style="width: 20%" class="text-right">Nombre Completo:</th>
                          <td style="width: 30%">{{$vehiculo[0]->nombre}}, {{$vehiculo[0]->apellido}}</td>
                        </tr>                    
                        <tr>
                          <th style="width: 20%" class="text-right">Estatus:</th>
                          <td style="width: 30%">
                          @if ($vehiculo[0]->status_persona == 0)                            
                            <span class="label label-success">Activo</span>
                          @else
                            <span class="label label-danger">Inactivo</span>
                          @endif
                          </td>                          
                          <th style="width: 20%" class="text-right">Registro:</th>
                          <td style="width: 30%">{{$vehiculo[0]->created_at}}</td>
                        </tr>

                        <tr>
                          <th style="width: 20%" class="text-right">Última Entrada:</th>
                          <td style="width: 30%">{{$vehiculo[0]->updated_at}}</td>
                          <th style="width: 20%" class="text-right">Género:</th>
                          <td style="width: 30%">{{$vehiculo[0]->genero}}</td>
                        </tr>

                        <tr>
                          <th style="width: 20%" class="text-right">País:</th>
                          <td style="width: 30%"><img title="{{$vehiculo[0]->pais_persona}}" style="width:20px" src="data:{{$vehiculo[0]->formato_pais_imagen_persona}};base64,{{$vehiculo[0]->pais_imagen_persona}}" /> {{$vehiculo[0]->pais_persona}}</td>
                          <th style="width: 20%" class="text-right">Email:</th>
                          <td style="width: 30%">{{$vehiculo[0]->email}}</td>
                        </tr>

                        <tr>
                          <th style="width: 20%" class="text-right">Servicio:</th>
                          <td style="width: 30%">{{$vehiculo[0]->servicio_persona}}</td>                          
                        </tr>
                      </table>
                    </div>
                    </div>                    
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->   
            
          </div>  

@endsection