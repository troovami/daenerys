@extends('template.app')
@section('page', $page_title)
@section('padre', 'Telefono')
@section('content')
<section class="content col-md-12" style="background: #ECF0F5;">
          <div class="row">  
          	<div class="col-md-4">

               <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-image"></i> Imagenes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    	
                    			<li data-target="#carousel-example-generic" data-slide-to="" class="active"></li>
          						                 
                    </ol>

                    <div class="carousel-inner">  
                    	             	              	                    	
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                  
                  <br>																					
													
                  
</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->  
           	<div class="col-md-8">
              <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1_1">
                    <table class="table table-bordered ">
                        <tr>
                          <th style="width: 16.5%" class="text-right">Status de Usuario:</th>
                          <td style="width: 16.5%"></td>
                          <th style="width: 16.5%" class="text-right">Activación:</th>
                          <td style="width: 16.5%"></td>
                          <th style="width: 16.5%" class="text-right">Estado:</th>
                          <td style="width: 16.5%"><span class="label label-success"><i class="fa fa-check"></i></span></td>
                         </tr>                                            

                        <tr>
                          <th style="width: 25%" class="text-right">Tipo:</th>
                          <td style="width: 25%"></td>
                          <th style="width: 25%" class="text-right">Clasificacion:</th>
                          <td style="width: 25%"></td>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Marca:</th>
                          <td style="width: 16.5%">{{$telefono[0]->marca}}</td>  
                          <th style="width: 16.5%" class="text-right">Modelo:</th>
                          <td style="width: 16.5%">{{$telefono[0]->modelo}}</td> 
                          <th style="width: 16.5%" class="text-right">Version:</th>
                          <td style="width: 16.5%">{{$telefono[0]->version}}</td>                       
                        </tr>

                       <?php $j='0'; $i='0'; $k='0';?>
                        @foreach ($especificacion as $detalles)
                          <tr>
                            @if ($detalles->titulo==$j)
                            <th style="width: 16.5%;color: red;" class="text-right" ></th>
                            @else
                            <?php $j=$detalles->titulo ?>
                            <th style="width: 16.5%;color: red;" class="text-right"><span>{{$detalles->titulo}}</span></th>
                            @endif

                            @if ($detalles->subtitulo==$k)
                            <th style="color:black" ></th>
                            @else
                            <?php $k=$detalles->subtitulo ?>
                            <th style="width: 16.5%" class="text-right"><span>{{$detalles->subtitulo}}:</span></th>
                            @endif
                            <td colspan="2">{{$detalles->valor}}</td>
                          </tr>

                        @endforeach

                     <!--<tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Red</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Velocidad:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">GPRS:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">EDGE:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>
                       
                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Cuerpo</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Alto:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Ancho:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Profundidad:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Peso:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Tipo de SIM CARD:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Adicionales:</th>
                          <td style="width: 16.5%"></td>                        
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Color:</th>
                          <td style="width: 16.5%"></td> 
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Pantalla</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Tamaño:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Resolución:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Multitouch:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Tecnología:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Protección:</th>
                          <td style="width: 16.5%"></td> 
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Plataforma</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">OS:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Tarjeta:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">CPU:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Memoria</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Ranura para Tarjeta de Memoria:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Interno:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">RAM:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Camara</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Camara Trasera:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Camara Frontal:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Flash:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Optical Zoom:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Video:</th>
                          <td style="width: 16.5%"></td> 
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Sonido</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Customización:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Vibración:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Otros Detalles:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Conectividad</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">WLAN:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Bluetooth:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">GPS:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">NFC:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Radio:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">USB:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Otra:</th>
                          <td style="width: 16.5%"></td>  
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Caracteristicas</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Sensores:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Mensajeria:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Navegador:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Java:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Otra:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%;color: red;" class="text-right">Bateria</th>
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Capacidad:</th>
                          <td style="width: 16.5%"></td>  
                          <th style="width: 16.5%" class="text-right">Tipo:</th>
                          <td style="width: 16.5%"></td> 
                          <th style="width: 16.5%" class="text-right">Modo Reposo:</th>
                          <td style="width: 16.5%"></td>                       
                        </tr>

                        <tr>
                          <th style="width: 16.5%" class="text-right">Tiempo de conversación:</th>
                          <td style="width: 16.5%"></td>  
                        </tr>-->
                  </table>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->   
            
          </div>  


@endsection