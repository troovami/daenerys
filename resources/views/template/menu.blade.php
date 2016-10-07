<p style="display:none">{{ $rol = Auth::user()->lng_idrol }}</p>
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('images/troovami-logo-online.png') }}" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>&laquo; {{ Auth::user()->name }} &raquo;</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Disponible</a>
			</div>
		</div>
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Buscador..." /> <span class="input-group-btn">
					<button type="submit" name="search" id="search-btn"class="btn btn-flat">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<ul class="sidebar-menu">
			<li class="treeview"><a href="{{route('home')}}"> <i class="fa fa-home"></i> <span>Principal</span><i class="fa fa-angle-left pull-right"></i></a>
			@if($rol == 1)
			<li class="treeview"><a href="#"> <i class="fa fa-car"></i> <span>Vehiculos</span><i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o text-green"></i> Publicaciones<i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{route('vehicles.publicaciones-activas')}}"><i class="fa fa-circle-o text-light-blue"></i> Activas</a></li>
							<li><a href="{{route('vehicles.publicaciones-inactivas')}}"><i class="fa fa-circle-o text-light-blue"></i> Inactivas</a></li>
						</ul>
					</li>
					<li><a href="#"><i class="fa fa-circle-o text-green"></i> Opciones del Formulario<i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Descripciones <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Tipos de Vehiculos</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Clasificaciones</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Modelos</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Colores</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Dirección</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Estereo</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Transmisión</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Tapizado</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Vidrios</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Tracción</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Combustible</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Cilindrada</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Sistema de Frenos</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Arranque</a></li>
								</ul>
							</li>
							<li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Características <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Seguridad</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Sonido</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Exterior</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Confort</a></li>
									<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Accesorios Internos</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			@endif
			<li class="treeview"><a href="#"> <i class="fa fa-globe"></i> <span>Opciones Globales</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
				@if($rol == 1)
					<li><a href="#"><i class="fa fa-user-secret text-green"></i> Administradores <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{route('admin.create')}}"><i class="fa fa-circle-o text-light-blue"></i> Agregar Admin</a></li>
							<li><a href="{{route('admin.index')}}"><i class="fa fa-circle-o text-light-blue"></i> Consultar Admins</a></li>
							<li><a href="{{route('admin.profile')}}"><i class="fa fa-circle-o text-light-blue"></i> Mi Perfil</a></li>
						</ul>
					</li>
				@endif
				@if($rol == 3 || $rol == 1)
					<li><a href="#"><i class="fa fa-user-plus text-green"></i> Supervisores <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="active"><a href="{{route('supervisor.publicaciones')}}"><i class="fa fa-circle-o text-light-blue"></i> Ver Publicaciones</a></li>
						</ul>
					</li>
				@endif
				@if($rol == 1 || $rol == 3 || $rol == 4)
					<li><a href="#"><i class="fa fa-user-plus text-green"></i> Operadores <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="active"><a href="{{route('operador.revision')}}"><i class="fa fa-circle-o text-light-blue"></i> Publicaciones en Revision</a></li>
						</ul>
					</li>
				@endif
				@if($rol == 1)
					<li><a href="#"><i class="fa fa-user-plus text-green"></i> Usuarios <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="active"><a href="{{route('persona.create')}}"><i class="fa fa-circle-o text-light-blue"></i> Agregar Usuario</a></li>
							<li><a href="{{route('persona.index')}}"><i class="fa fa-circle-o text-light-blue"></i> Consultar Usuarios</a></li>
						</ul>
					</li>
					<li><a href="#"><i class="fa fa-briefcase text-green"></i> Empresas <i class="fa fa-angle-left pull-right"></i></a> 
						<!--<ul class="treeview-menu">
		                    <li><a href="#"><i class="fa fa-plus-square text-green"></i> </a></li>
		                    <li><a href="#"><i class="fa fa-users text-light-blue"></i> </a></li>
		                    <li><a href="#"><i class="fa fa-user-secret text-light-blue"></i> </a></li>
		                    <li><a href="#"><i class="fa fa-circle-o"></i> </a></li>
		                    <li>
		                      <a href="#"><i class="fa fa-circle-o"></i> <i class="fa fa-angle-left pull-right"></i></a>
		                      <ul class="treeview-menu">
		                        <li><a href="#"><i class="fa fa-circle-o"></i> </a></li>
		                        <li><a href="#"><i class="fa fa-circle-o"></i> </a></li>
		                      </ul>
		                    </li>
		                  </ul>-->
                  	</li>
					<li><a href="#"><i class="fa fa-flag text-green"></i> Paises <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{route('pais.create')}}"><i class="fa fa-plus-square text-green"></i> Agregar Pais</a></li>
							<li><a href="{{route('pais.index')}}"><i class="fa fa-flag text-light-blue"></i> Consultar Paises</a></li>
						</ul>
					</li>
					<li><a href="#"><i class="fa fa-bullseye text-green"></i> Marcas <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="active"><a href="{{route('marca.create')}}"><i class="fa fa-plus-square text-green"></i> Agregar Marca</a></li>
							<li><a href="{{route('marca.index')}}"><i class="fa fa-bullseye text-light-blue"></i> All Marcas</a></li>
							<li><a href="{{route('marca.mobile')}}"><i class="fa fa-tablet text-light-blue"></i> Marcas Móviles</a></li>
							<li><a href="{{route('marca.vehicle')}}"><i class="fa fa-car text-light-blue"></i> Marcas Vehículos</a></li>
							<!--<li><a href="{{route('marca.vehicle')}}"><i class="fa fa-globe text-light-blue"></i> SEO Tipos Asociados</a></li>-->
						</ul>
					</li>
				@endif
				</ul>
			</li>
		</ul>
	</section>
</aside>