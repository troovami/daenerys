<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('images/troovami-logo-online.png') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p> &laquo; {{ Auth::user()->name }} &raquo;</p>              
              <a href="#"><i class="fa fa-circle text-success"></i> Disponible</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Buscador..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Principal</span></a></li>
            <!-- ############################################################################## -->
            <li class="header text-aqua"><i class="fa fa-globe"></i> MENU GLOBAL</li>
            <!-- ############################################################################## -->
            
            <!-- Administradores -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-secret"></i> <span>Administradores</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('admin.create')}}"><i class="fa fa-plus-square text-green"></i> Agregar Admin</a></li>                
                <li><a href="{{route('admin.index')}}"><i class="fa fa-users text-light-blue"></i> All Admins</a></li>
                <li><a href="{{route('admin.profile')}}"><i class="fa fa-user-secret"></i> Mi Perfil</a></li>
              </ul>
            </li>           
            <!-- /fin -->

            <!-- Personas -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-plus"></i> <span>Personas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{route('persona.create')}}"><i class="fa fa-plus-square text-green"></i> Agregar Persona</a></li>
                <li><a href="{{route('persona.index')}}"><i class="fa fa-users text-light-blue"></i> All Personas</a></li>                
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Empresas -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-briefcase"></i> <span>Empresas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Empresa</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Empresa</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Empresa</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Empresa</a></li>
              </ul>
            </li>           
            <!-- /fin -->

            <!-- Paises -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-flag"></i> <span>Paises</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('pais.create')}}"><i class="fa fa-plus-square text-green"></i> Agregar Pais</a></li>
                <li><a href="{{route('pais.index')}}"><i class="fa fa-flag text-light-blue"></i> All Paises</a></li>
              </ul>
            </li>           
            <!-- /fin -->   
            <!-- Marcas -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bullseye"></i> <span>Marcas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{route('marca.create')}}"><i class="fa fa-plus-square text-green"></i> Agregar Marca</a></li>
                <li><a href="{{route('marca.index')}}"><i class="fa fa-bullseye text-light-blue"></i> All Marcas</a></li>
              </ul>
            </li>           
            <!-- /fin -->         
            <!-- ############################################################################## -->
            <li class="header text-aqua"><i class="fa fa-tablet"></i> MOBILE</li>
            <!-- ############################################################################## -->
            <!-- Moviles -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tablet"></i> <span>Moviles</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Movil</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Movil</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Movil</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Movil</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Noticias -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-newspaper-o"></i> <span>Noticias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Noticia</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Noticia</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Noticia</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Noticia</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Vocalularios -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Vocalularios Noticias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Vocalulario</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Vocalulario</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Vocalulario</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Vocalulario</a></li>
              </ul>
            </li>           
            <!-- /fin -->            
            <!-- Frecuencias -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bolt"></i> <span>Frecuencias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Frecuencia</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Frecuencia</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Frecuencia</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Frecuencia</a></li>
              </ul>
            </li>           
            <!-- /fin -->            
            <!-- Tecnologias -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-code-fork"></i> <span>Tecnologias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Tecnologia</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Tecnologia</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Tecnologia</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Tecnologia</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Operadoras -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-phone-square"></i> <span>Operadoras</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Persona</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Persona</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Persona</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Persona</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Taxonomias -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Taxonomias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Taxonomia</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Taxonomia</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Taxonomia</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Taxonomia</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Especificaciones -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i> <span>Especificaciones</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Especificacion</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Especificacion</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Especificacion</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Especificacion</a></li>
              </ul>
            </li>           
            <!-- /fin --> 
            <!-- Valores Especificaciones -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Valores Especificaciones</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Tecnologia</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Tecnologia</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Tecnologia</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Tecnologia</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- Ventas -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cart-plus"></i> <span>Ventas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">                
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Ventas</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- ############################################################################## -->
            <li class="header text-aqua"><i class="fa fa-car"></i> CARS</li>
            <!-- ############################################################################## -->
            <!-- Vehiculos -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bus"></i> <span>Vehiculos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Vehiculo</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Vehiculo</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Vehiculo</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Vehiculo</a></li>
              </ul>
            </li>           
            <!-- /fin -->
            <!-- ############################################################################## -->
            <li class="header text-aqua"><i class="fa fa-building"></i> HOUSE</li>
            <!-- ############################################################################## -->
            <!-- Inmuebles -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-building-o"></i> <span>Inmuebles</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-plus-square text-green"></i> Agregar Inmueble</a></li>
                <li><a href="#"><i class="fa fa-pencil text-yellow"></i> Editar Inmueble</a></li>
                <li><a href="#"><i class="fa fa-search text-aqua"></i> Consultar Inmueble</a></li>
                <li><a href="#"><i class="fa fa-user-times text-red"></i> Desactivar Inmueble</a></li>
              </ul>
            </li>           
            <!-- /fin -->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>