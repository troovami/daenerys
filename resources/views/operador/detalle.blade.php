@extends('template.app')
@section('page', $page_title)
@section('padre', 'Vehiculo')
@section('content')
<section class="content col-md-12">
          <div class="row">  
          	<div class="col-md-4">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-calendar"></i> Fecha de Publicación</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered ">
                    <tr>
                      <th style="width: 16.5%" class="text-right">Fecha de Inicio:</th>
                      <td style="width: 16.5%">{{$vehiculo[0]->v_fecha_publicacion_inicio}}</td>
                      <th style="width: 16.5%" class="text-right">Fecha Fin:</th>
                      <td style="width: 16.5%">{{$vehiculo[0]->v_fecha_publicacion_fin}}</td>
                    </tr>
                  </table>                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->

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

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="glyphicon glyphicon-align-justify"></i> Comentario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  @if ($vehiculo[0]->v_comentario == null)  
                  <h4><span data-toggle="tooltip" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> Publicación sin Comentario</span></h4>
                  @else
                  {{$vehiculo[0]->v_comentario}}
                  @endif                                    
                </div><!-- /.box-body -->
              </div><!-- /.box -->            

              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-film"></i> Video</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  @if ($vehiculo[0]->v_video == null)  
                  <h4><span data-toggle="tooltip" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> Publicación sin Video</span></h4>
                  @else
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$vehiculo[0]->v_video}}" frameborder="0" allowfullscreen></iframe>
                  </div>
                  @endif              
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
                      Acciones <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('operador.activar',$idVehiculo)}}">Activar</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('operador.desactivar',$idVehiculo)}}">No Activar</a></li>
                    </ul>
                  </li>   
                  <li class="pull-left header"><i class="fa fa-car"></i> {{$vehiculo[0]->v_marca}} {{$vehiculo[0]->v_modelo}} {{$vehiculo[0]->v_anio}}</li>              
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
                            <p>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'seguridad_vehiculos')                            
                              <span class="label label-primary" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                            </p>                          
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
                          <p>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'sonido_vehiculos')                            
                              <span class="label label-danger" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </p>
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
                          <p>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'exterior_vehiculos')                            
                              <span class="label label-success" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </p>
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
                          <p>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'confort_vehiculos')                            
                              <span class="label label-default" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </p>
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
                          <p>
                          @for ($j = 0; $j < count($detalleVehiculo); $j++)                            
                            @if ($detalleVehiculo[$j]->v_tipo == 'accesoriosInternos_vehiculos')                            
                              <span class="label label-warning" title="{{$detalleVehiculo[$j]->v_descripcion}}">{{$detalleVehiculo[$j]->v_descripcion}}</span>
                            @endif 
                          @endfor 
                          </p>
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
                          <th style="width: 16.5%" class="text-right">Status de Usuario:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_status_user}}</td>
                          <th style="width: 16.5%" class="text-right">Activación:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_bol_activa}}</td>
                          <th style="width: 16.5%" class="text-right">Estado:</th>
                          <?php
                          if($vehiculo[0]->v_status_admin == "710")
                          {
                          	echo '<td style="width: 16.5%"><span class="label label-success"><i class="fa fa-check"></i> Publicacion en Revision</span></td>';
                          }
                          elseif($vehiculo[0]->v_status_admin == "708")
                          {
                          	echo '<td style="width: 16.5%"><span class="label label-success"><i class="fa fa-check"></i> Publicacion Activa</span></td>';
                          }
                          else
                          {
                          	echo '<td style="width: 16.5%"><span class="label label-success"><i class="fa fa-check"></i> Publicacion Inactiva</span></td>';
                          }
                          ?>
                         </tr>                                            

                        <tr>
                          <th style="width: 16.5%" class="text-right">Tipo:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_tipo}}</td>
                          <th style="width: 16.5%" class="text-right">Clasificacion:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_clasificacion}}</td>
                          <th style="width: 16.5%" class="text-right">Marca:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_marca}}</td>                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Version:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_version}}</td>
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
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
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
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_equipo_medico}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Pisos:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_pisos}}</td>
                          <th style="width: 16.5%" class="text-right">Alto:</th>
                          @if ($vehiculo[0]->v_alto == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_alto}}</td>
                          @endif                           
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Ancho:</th>
                          @if ($vehiculo[0]->v_ancho == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_ancho}}</td>
                          @endif
                          <th style="width: 16.5%" class="text-right">Carroceria:</th>
                          @if ($vehiculo[0]->v_carroceria == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_carroceria}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Frenado:</th>
                          @if ($vehiculo[0]->v_frenado == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_frenado}}</td>
                          @endif                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Carga:</th>
                          @if ($vehiculo[0]->v_carga == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_carga}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Levantamiento:</th>
                          @if ($vehiculo[0]->v_levantamiento == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_levantamiento}}</td>
                          @endif                           
                          <th style="width: 16.5%" class="text-right">Lastre:</th>
                          @if ($vehiculo[0]->v_lastre == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_lastre}}</td>
                          @endif                           
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Largo:</th>
                          @if ($vehiculo[0]->v_largo == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_largo}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Aceite:</th>
                          @if ($vehiculo[0]->v_aceite == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_aceite}}</td>
                          @endif                           
                          <th style="width: 16.5%" class="text-right">Potencia Bruta:</th>
                          @if ($vehiculo[0]->v_potencia_bruta == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_potencia_bruta}}</td>
                          @endif                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Tambor:</th>
                          @if ($vehiculo[0]->v_tambor == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_tambor}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Produccion:</th>
                          @if ($vehiculo[0]->v_produccion == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_produccion}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Enfriamiento:</th>
                          @if ($vehiculo[0]->v_enfriamiento == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_enfriamiento}}</td>
                          @endif                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Neumatico:</th>
                          @if ($vehiculo[0]->v_neumatico == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_neumatico}}</td>
                          @endif                           
                          <th style="width: 16.5%" class="text-right">Potencia:</th>
                          @if ($vehiculo[0]->v_potencia == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_potencia}}</td>
                          @endif                           
                          <th style="width: 16.5%" class="text-right">Velocidades:</th>
                          @if ($vehiculo[0]->v_velocidades == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_velocidades}}</td>
                          @endif                           
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Pasajeros:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_pasajeros}}</td>
                          <th style="width: 16.5%" class="text-right">Horas uso:</th>
                          @if ($vehiculo[0]->v_horas_uso == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_horas_uso}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Negociable:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_negociable}}</td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Traccion:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_traccion}}</td>
                          <th style="width: 16.5%" class="text-right">Tapizado:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_tapizado}}</td>                         
                          <th style="width: 16.5%" class="text-right">Motor Reparado:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_motor_reparado}}</td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Vidrios:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_vidrios}}</td>
                          <th style="width: 16.5%" class="text-right">Cantidad de Puertas:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_cantidad_puertas}}</td>                         
                          <th style="width: 16.5%" class="text-right">Cantidad de Puertas:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_cantidad_puertas}}</td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Color:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_color}}</td>
                          <th style="width: 16.5%" class="text-right">Combustible:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_combustible}}</td>                         
                          <th style="width: 16.5%" class="text-right">Unico Dueño:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_unico_dueno}}</td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Recorrido:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_str_recorrido}}</td>
                          <th style="width: 16.5%" class="text-right">Potencia maxima:</th>
                          @if ($vehiculo[0]->v_potencia_max == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_potencia_max}}</td>
                          @endif                         
                          <th style="width: 16.5%" class="text-right">Tipo de Motor:</th>
                          @if ($vehiculo[0]->v_tipo_motor == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_tipo_motor}}</td>
                          @endif                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Financiamiento:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_financiamiento}}</td>
                          <th style="width: 16.5%" class="text-right">Chocado:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_chocado}}</td>                         
                          <th style="width: 16.5%" class="text-right">Recibo Moto:</th>
                          @if ($vehiculo[0]->v_recibo_moto == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_recibo_moto}}</td>
                          @endif                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Sistema de Arranque:</th>
                          @if ($vehiculo[0]->v_sistema_arranque == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_sistema_arranque}}</td>
                          @endif                          
                          <th style="width: 16.5%" class="text-right">Esloralargo:</th>
                          @if ($vehiculo[0]->v_esloralargo == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_esloralargo}}</td> 
                          @endif                                                  
                          <th style="width: 16.5%" class="text-right">Manga Ancho:</th>
                          @if ($vehiculo[0]->v_manga_ancho == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_manga_ancho}}</td>
                          @endif                          
                        </tr>

                         <tr>
                          <th style="width: 16.5%" class="text-right">Maximo de Tripulantes:</th>
                          @if ($vehiculo[0]->v_max_tripulantes == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_max_tripulantes}}</td>
                          @endif                           
                          <th style="width: 16.5%" class="text-right">Material:</th>
                          @if ($vehiculo[0]->v_material == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_material}}</td>
                          @endif                                                    
                          <th style="width: 16.5%" class="text-right">Peso:</th>
                          @if ($vehiculo[0]->v_peso == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_peso}}</td>
                          @endif                           
                        </tr>

                        <tr>                          
                          <th style="width: 16.5%" class="text-right">País:</th>
                          <td style="width: 16.5%"><img title="{{$vehiculo[0]->v_pais}}" style="width:20px" src="data:{{$vehiculo[0]->formato_v_pais_imagen}};base64,{{$vehiculo[0]->v_pais_imagen}}" /> {{$vehiculo[0]->v_pais}}</td>                          
                          <th style="width: 16.5%" class="text-right">Ciudad:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_ciudad}}</td>                         
                          <th style="width: 16.5%" class="text-right">Precio de Venta:</th>
                          @if($vehiculo[0]->v_moneda=="")
                            <td style="width: 16.5%">{{$vehiculo[0]->v_precio_venta}} <small>{{$vehiculo[0]->v_moneda_abreviatura}} <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="Moneda &laquo; {{$vehiculo[0]->v_moneda_pais}} &raquo;"></i></small></td>
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_precio_venta}} <small>USD <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="Moneda &laquo; Dólares Americanos &raquo;"></i></small></td>
                          @endif                          
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Última Actualización:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_updated_at}}</td>
                          <th style="width: 16.5%" class="text-right">Fecha de Creación:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_created_at}}</td>                         
                          <th style="width: 16.5%" class="text-right">Status de Usuario:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_status_user}}</td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Status Admin:</th>
                          <td style="width: 16.5%">{{$vehiculo[0]->v_status_admin}}</td>
                          <th style="width: 16.5%" class="text-right">Baño:</th>
                          @if ($vehiculo[0]->v_bano == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_bano}}</td>
                          @endif                                                   
                          <th style="width: 16.5%" class="text-right">Ventana:</th>
                          @if ($vehiculo[0]->v_ventana == 0)  
                            <td style="width: 16.5%"><span data-toggle="tooltip" data-placement="top" title="No Aplica en {{$vehiculo[0]->v_tipo}} ({{$vehiculo[0]->v_clasificacion}})" class="label label-default"><i class="glyphicon glyphicon-info-sign"></i> No Aplica</span></td>                            
                          @else
                            <td style="width: 16.5%">{{$vehiculo[0]->v_ventana}}</td>
                          @endif                          
                        </tr>

                       
                        <!--            
              
            
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
