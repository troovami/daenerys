@extends('template.app')
@section('page', $page_title)
@section('padre', 'Móvil')
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
                
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> {{$page_title}} Móvil</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
					<div class="box-body">                 
					{!! Form::open(['route' => 'telefono.create', 'class' => 'form','enctype'=>'multipart/form-data']) !!}

						<div class="form-group col-md-12">
						   	<div class="panel-groupid" id="accordion">
						   	
							   	<div class="panel panel-default">
							      <div class="panel-heading">
							        <h4 class="panel-title">
							          <a data-toggle="collapse" data-parent="#accordion" href="#campos_genericos">Campos Genericos</a>
							        </h4>
							      </div>
							      <div id="campos_genericos" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="form-group col-md-6">
												<label>Marca</label> 
												{!! Form::select('str_marca[]', 
												([null=>'Indique una Marca Ej: Blu'] + $marcas), 
												null, 
												['class' => 'form-control select2','id'=>'marca','name'=>'','onchange'=>'','required'=>'']
												) 
												!!} 
											</div>  
											<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
											<div class="form-group col-md-6">
												<label>Modelo</label>
												<div id="modelo"></div>
											</div>

											<div class="form-group col-md-12">
												<label>Versión</label>
												{!! Form::input('text', 'str_version', '', ['id' => 'str_version', 'class'=> 'form-control','required']) !!}
											</div>

											<div>
												<div class="form-group col-md-4">
													<label>Img Normal</label>
													<input type="hidden" name="lusmi" id="lusmi" value="1">
													{!! Form::file('blb_img_normal',['id'=>'temporal','class'=> 'form-control','placeholder'=>'']) !!}                              
												</div> 

												<div class="form-group col-md-4">
													<label>Img Mini</label>
													{!! Form::file('blb_img_mini',['class'=> 'form-control','placeholder'=>'']) !!}  
												</div> 

												<div class="form-group col-md-4">
													<label>Img Zoom</label>
													{!! Form::file('blb_img360',['class'=> 'form-control','placeholder'=>'']) !!} 
												</div>
												<div class="form-group col-md-12 more_img">Agregar más Imagenes</div>
											</div> 
										</div>

									</div>

								</div>

							<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#red">Red</a>
											</h4>
										</div>
								      	<div id="red" class="panel-collapse collapse">
									        <div class="panel-body">
								        		<div class="form-group col-md-12">
									                <label>Velocidad</label>
									                <input type="hidden" name="lng_idespecificacion[]" value="1">
									                <input type="hidden" name="str_titulo[]" value="Velocidad">
									                {!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion', 'class'=> 'form-control','required','placeholder'=>'HSPA 42.2/5.76 Mbps, LTE Cat4 150/50 Mbps, EV-DO Rev.A 3.1 Mbps']) !!}
								        		</div>
								                <div class="form-group col-md-12">
													<label for="sel1">GPRS</label>
													<input type="hidden" name="lng_idespecificacion[]" value="1">
													<input type="hidden" name="str_titulo[]" value="GPRS">
													<select class="form-control" id="sel1" name="str_descripcion[]">
														<option value="SI">SI</option>
												    	<option value="NO">NO</option>
													</select>
												</div>
								                <div class="form-group col-md-12">
												  <label for="sel1">EDGE</label>
												  <input type="hidden" name="lng_idespecificacion[]" value="1">
												  <input type="hidden" name="str_titulo[]" value="EDGE">
												  <select class="form-control" id="sel1" name="str_descripcion[]" >
												    	<option value="SI">SI</option>
												    	<option value="NO">NO</option>
												  </select>
												</div>
									        </div> 
								    	</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#lanzamiento">Lanzamiento</a>
									</h4>
								</div>
								<div id="lanzamiento" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-6">
											<label>Fecha de Lanzamiento</label>
											<input type="hidden" name="lng_idespecificacion[]" value="2">
											<input type="hidden" name="str_titulo[]" value="Fecha de Lanzamiento">
											<div class="input-group date" data-provide="datepicker" data-language="es">
											     <input type="text" class="form-control" name="str_descripcion[]">
											     <div class="input-group-addon">
											        <span class="glyphicon glyphicon-th"></span>
											     </div>
										   	</div>
									   </div>
									   <div class="form-group col-md-6">
										<label>Disponible a partir de</label>								    <input type="hidden" name="lng_idespecificacion[]" value="2">
										<input type="hidden" name="str_titulo[]" value="Disponible a partir de">
										<div class="input-group date" data-provide="datepicker" data-language="es">
									     <input type="text" class="form-control" name="str_descripcion[]">
									     <div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
									     </div>
									   </div>
									   </div>
									</div>   
								</div>
					    	</div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#cuerpo">Cuerpo</a>
						        </h4>
						      </div>
						      <div id="cuerpo" class="panel-collapse collapse">
							       	<div class="panel-body">
							       		<div class="form-group col-md-4">
							       			<label>Alto</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="3">
							       			<input type="hidden" name="str_titulo[]" value="Alto">
							       			{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control simple-field-data-mask-clearifnotmatch','required','placeholder'=>"150 mm",'data-mask'=>"999 mm", 'data-mask-clearifnotmatch'=>'true']) !!}
							            </div>
							       		<div class="form-group col-md-4">
							       			<label>Ancho</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="3">
							       			<input type="hidden" name="str_titulo[]" value="Ancho">
							            	{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'70 mm']) !!}
							            </div>
							            
							       		<div class="form-group col-md-4">
							       			<label>Profundidad</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="3">
							       			<input type="hidden" name="str_titulo[]" value="Profundidad">
							            	{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'8.5 mm']) !!}
							       		</div>
									    
										<div class="form-group col-md-6">
							       			<label>Peso</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="3">
							       			<input type="hidden" name="str_titulo[]" value="Peso">
							           		 {!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'120 g']) !!}
							       		</div>
									    
										<div class="form-group col-md-6">
							       			<label>Tipo de SIM CARD</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="3">
							       			<input type="hidden" name="str_titulo[]" value="Tipo de SIM CARD">
							       			<select name="str_descripcion[]" id="str_descripcion[]" class ="form-group select2" style="width: 304px;!important">
							       				<option>Seleccione un Tipo de SIM Card</option>
											    @foreach($simcard as $sc)
											    <option value="{{$sc->simcard}}">{{$sc->simcard}}</option>
											    @endforeach
											</select>
							       		</div>
					                    <div class="form-group col-md-12">
							       			<label>Adicionales</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="3">
							       			<input type="hidden" name="str_titulo[]" value="Adicionales">
							            	{!! Form::textarea('str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'']) !!}
										
							       		</div>
										<div class="form-group col-md-12">
							       			<label>Color</label>
								       		<table style="width:100%">
												  <tr>
												    <th style="padding-bottom: 25px;"></th>
												    <th style="padding-bottom: 25px;">Nombre</th> 
												    <th style="padding-bottom: 25px;">Seleccionar</th>
												  </tr>
									        @foreach ($color as $colors)
									           	<tr>
												    <td style="padding-bottom: 25px;"><a style="background:<?=$colors->id_color;?>;height: 25px;width: 25px;margin-left: 15px;border: 10px inset <?=$colors->id_color;?>"></a>&emsp;</td>
												    <td style="padding-bottom: 25px;">{{$colors->nombre_color}}</td> 
												    <td style="padding-bottom: 25px;">
												    <input type="hidden" name="str_titulo_color[]" id ="str_titulo_color[]" value="Color">
												    <input class="" name="str_color[]" id ="str_color[]" type="checkbox" value="{{$colors->nombre_color}}"></td>
												</tr>
										    @endforeach
										    </table>
							       		</div>
									</div>  
						      </div>
						  	</div> 

						  	<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#pantalla">Pantalla</a>
									</h4>
								</div>
								<div id="pantalla" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-4">
											<label>Tamaño</label>
							       			<input type="hidden" name="lng_idespecificacion[]" value="4">
											<input type="hidden" name="str_titulo[]" value="Tamaño">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control simple-field-data-mask-clearifnotmatch','required','placeholder'=>"10'",'data-mask'=>"00'", 'data-mask-clearifnotmatch'=>'true']) !!}
										</div>

										<div class="form-group col-md-4">
											<label>Resolucion</label>
											<input type="hidden" name="lng_idespecificacion[]" value="4">
											<input type="hidden" name="str_titulo[]" value="Resolucion">   
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'1024px x 620px']) !!}
										</div>

										<div class="form-group col-md-4">
											<label>Multitouch</label>
											<input type="hidden" name="lng_idespecificacion[]" value="4">
											<input type="hidden" name="str_titulo[]" value="Multitouch">
												<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>

										<div class="form-group col-md-6">
											<label>Tecnología</label><br>
											<input type="hidden" name="lng_idespecificacion[]" value="4">
											<input type="hidden" name="str_titulo[]" value="Tecnología">
											<select name="str_descripcion[]" id="str_descripcion[]" class ="form-group select2" style="width: 304px;!important">
							       				<option>Seleccione una Tecnología</option>
											    @foreach($tipo_pantalla as $tp)
											    <option value="{{$tp->tipo_pantalla}}">{{$tp->tipo_pantalla}}</option>
											    @endforeach
											</select>
										</div>

										<div class="form-group col-md-6">
											<label>Proteccion</label>
											<input type="hidden" name="lng_idespecificacion[]" value="4">
											<input type="hidden" name="str_titulo[]" value="Proteccion">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Gorilla Glass 4']) !!}
										</div>
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#plataforma">Plataforma</a>
									</h4>
								</div>
								<div id="plataforma" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-12">
											<label>OS</label>
											<input type="hidden" name="lng_idespecificacion[]" value="5">
											<input type="hidden" name="str_titulo[]" value="OS">
											<select name="str_descripcion[]" id="str_descripcion[]" class ="form-group select2" style="width: 100%;!important">
							       				<option>Seleccione una OS</option>
											    @foreach($so as $s)
											    <option value="{{$s->so_nombre}}">{{$s->so_nombre}}</option>
											    @endforeach
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Tarjeta</label>
											<input type="hidden" name="lng_idespecificacion[]" value="5">
											<input type="hidden" name="str_titulo[]" value="Tarjeta">   
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Qualcomm MSM8937 Snapdragon 430']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>CPU</label>
											<input type="hidden" name="lng_idespecificacion[]" value="5">
											<input type="hidden" name="str_titulo[]" value="CPU"> 
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Octa-core 1.4 GHz Cortex-A53']) !!}
										</div>
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#memoria">Memoria</a>
									</h4>
								</div>
								<div id="memoria" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-12">
											<label>Ranura para Tarjeta de Memoria</label>
											<input type="hidden" name="lng_idespecificacion[]" value="6">
											<input type="hidden" name="str_titulo[]" value="Ranura para Tarjeta de Memoria">
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label>Interno</label>
											<input type="hidden" name="lng_idespecificacion[]" value="6">
											<input type="hidden" name="str_titulo[]" value="Interno">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'256 MB']) !!}
										</div>
										<!--<div class="form-group col-md-6">
											<label for="sel1">Unidad de Medida</label>
											
											<select id="str_descripcion[]" name="str_descripcion[]" class ="form-group select2" style="width: 304px;!important">
							       				<option>Seleccione una Unidad de Medida</option>
											    @foreach($um as $u)
											    <option value="{{$u->um_nombre}}">{{$u->um_nombre}}</option>
											    @endforeach
											</select>
										</div>-->
										<div class="form-group col-md-6">
											<label>RAM</label>
											<input type="hidden" name="lng_idespecificacion[]" value="6">
											<input type="hidden" name="str_titulo[]" value="RAM">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'256 MB']) !!}
										</div>
										<!--<div class="form-group col-md-6">
											<label for="sel1">Unidad de Medida</label>
											
											<select id="str_descripcion[]" name="str_descripcion[]" class ="form-group select2" style="width: 304px;!important">
							       				<option>Seleccione una Unidad de Medida</option>
											    @foreach($um as $u)
											    <option value="{{$u->um_nombre}}">{{$u->um_nombre}}</option>
											    @endforeach
											</select>
										</div>-->
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#camara">Camara</a>
									</h4>
								</div>
								<div id="camara" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-6">
											<label>Camara Trasera</label>
											<input type="hidden" name="lng_idespecificacion[]" value="7">
											<input type="hidden" name="str_titulo[]" value="Camara Trasera">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control simple-field-data-mask','required','placeholder'=>'18 px','data-mask'=>"00 px"]) !!}
										</div>
										<div class="form-group col-md-6">
											<label>Camara Frontal</label>
											<input type="hidden" name="lng_idespecificacion[]" value="7">
											<input type="hidden" name="str_titulo[]" value="Camara Frontal">{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control simple-field-data-mask','required','placeholder'=>'18 px','data-mask'=>"00 px"]) !!}
										</div>
										<div class="form-group col-md-6">
											<label>Flash</label>
											<input type="hidden" name="lng_idespecificacion[]" value="7">
											<input type="hidden" name="str_titulo[]" value="Flash">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Xenon o LED']) !!}
										</div>
										<div class="form-group col-md-6">
											<label>Optical Zoom</label>
											<input type="hidden" name="lng_idespecificacion[]" value="7">
											<input type="hidden" name="str_titulo[]" value="Optical Zoom">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required']) !!}
										</div>
										<div class="form-group col-md-6">
											<label>Video</label>
											<input type="hidden" name="lng_idespecificacion[]" value="7">
											<input type="hidden" name="str_titulo[]" value="Video">
											<select name="str_descripcion[]" id="str_descripcion[]" class ="form-group select2" style="width: 100%;!important">
							       				<option>Seleccione una Resolución para Video</option>
											    @foreach($resolucion as $res)
											    <option value="{{$res->resolucion}}">{{$res->resolucion}}</option>
											    @endforeach
											</select>
										</div>
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#sonido">Sonido</a>
									</h4>
								</div>
								<div id="sonido" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-12">
											<label>Customización</label> 
											<input type="hidden" name="lng_idespecificacion[]" value="8">
											<input type="hidden" name="str_titulo[]" value="Customización">  
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>Vibración</label>
											<input type="hidden" name="lng_idespecificacion[]" value="8">
											<input type="hidden" name="str_titulo[]" value="Vibración">
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Otros Detalles</label>
											<input type="hidden" name="lng_idespecificacion[]" value="8">
											<input type="hidden" name="str_titulo[]" value="Otros Detalles">
											{!! Form::textarea('str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'']) !!}
										</div>
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#conectividad">Conectividad</a>
									</h4>
								</div>
								<div id="conectividad" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-12">
											<label>WLAN</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="WLAN">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Wi-Fi 802.11 a/b/g/n/ac, dual-band, WiFi Direct, hotspot']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>Bluetooth</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="Bluetooth">   
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'v3']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>GPS</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="GPS">
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>NFC</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="NFC">
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Radio</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="Radio">
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>USB</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="USB">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'USB 3.1']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>Otra</label>
											<input type="hidden" name="lng_idespecificacion[]" value="9">
											<input type="hidden" name="str_titulo[]" value="Otra">
											{!! Form::textarea('str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'']) !!}
										</div>
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#caracteristicas">Caracteristicas</a>
									</h4>
								</div>
								<div id="caracteristicas" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-12">
											<label>Sensores</label>
											<input type="hidden" name="lng_idespecificacion[]" value="10">
											<input type="hidden" name="str_titulo_sensores[]" id ="str_titulo_sensores[]" value="Sensores">
											<select name="str_sensores[]" id="str_sensores[]" class ="form-group select2" style="width: 100%!important;height: 100%!important;" multiple="multiple">
							       				<option>Indique los Sensores Ej: Giroscopio</option>
											    @foreach($sensor as $sen)
											    <option value="{{$sen->sensor}}">{{$sen->sensor}}</option>
											    @endforeach
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Mensajeria</label>
											<input type="hidden" name="lng_idespecificacion[]" value="10">
											<input type="hidden" name="str_titulo_mensajeria[]" id ="str_titulo_mensajeria[]" value="Mensajeria">
											<select name="str_mensajeria[]" id="str_mensajeria[]" class ="form-group select2" style="width: 100%!important;height: 100%!important;" multiple="multiple">
							       				<option>Indique las Mensajerias Ej: SMS</option>
											    @foreach($mensajeria as $men)
											    <option value="{{$men->mensajeria}}">{{$men->mensajeria}}</option>
											    @endforeach
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Navegador</label>
											<input type="hidden" name="lng_idespecificacion[]" value="10">
											<input type="hidden" name="str_titulo[]" value="Navegador">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'HTML5']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>Java</label>
											<input type="hidden" name="lng_idespecificacion[]" value="10">
											<input type="hidden" name="str_titulo[]" value="Java">
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="SI">SI</option>
													<option value="NO">NO</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Otra</label>
											<input type="hidden" name="lng_idespecificacion[]" value="10">
											<input type="hidden" name="str_titulo[]" value="Otra">
											{!! Form::textarea('str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'']) !!}
										</div>
									</div>  
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#bateria">Bateria</a>
									</h4>
								</div>
								<div id="bateria" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group col-md-12">
											<label>Capacidad</label>
											<input type="hidden" name="lng_idespecificacion[]" value="11">
											<input type="hidden" name="str_titulo[]" value="Capacidad">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'3000 mAh']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>Tipo</label> 
											<input type="hidden" name="lng_idespecificacion[]" value="11">
											<input type="hidden" name="str_titulo[]" value="Tipo"> 
											<select class="form-control" id="str_descripcion[]" name="str_descripcion[]">
													<option value="Removible">Removible</option>
													<option value="No Removible">No Removible</option>
											</select> 
										</div>
										<div class="form-group col-md-12">
											<label>Modo Reposo (Stand-by)</label>
											<input type="hidden" name="lng_idespecificacion[]" value="11">
											<input type="hidden" name="str_titulo[]" value="Modo Reposo (Stand-by)">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Hasta 250 h (3G)']) !!}
										</div>
										<div class="form-group col-md-12">
											<label>Tiempo de conversación</label>
											<input type="hidden" name="lng_idespecificacion[]" value="11">
											<input type="hidden" name="str_titulo[]" value="Tiempo de conversación">
											{!! Form::input('text', 'str_descripcion[]', '', ['id' => 'str_descripcion[]', 'class'=> 'form-control','required','placeholder'=>'Hasta 25 h (3G)']) !!}
										</div>
									</div>  
								</div>
							</div>
						  	
							</div>
						</div>

					<div class="form-group col-md-12">
                        {!! Form::submit('Agregar',['class' => 'btn btn-success btn-block']) !!}
                    </div>
					</div>

                   {!! Form::close() !!}
                <!-- form end -->
              </div>
        </div>
   </div><!-- /.box -->            
</div>
        <!-- col-md-4 col-md-offset-4 -->

 
@section('footer')
    <!-- Select2 -->
    {!! Html::script('admin-lte/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
    <script>
  $(document).ready(function() {
    $('.datepicker').datepicker({
   language: 'es'
	});
  });
</script>
<script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
         	$(".more_img").click(function () 
	         	{	
	    			if (($("#lusmi").val())==11111){
						alert("Maximo de Imagenes Permitido");
						return;
	         		} 
	         		document.getElementById('lusmi').value = ($("#lusmi").val())+1;
	             $(this).before('<div class="form-group col-md-4"><input type="file" name="blb_img_normal" class="form-control"></div><div class="form-group col-md-4"><input type="file" name="blb_img_mini" class="form-control"></div><div class="form-group col-md-4"><input type="file" name="blb_img360" class="form-control"></div>');

	            });

         });
      </script>
@endsection
@endsection