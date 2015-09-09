@extends('template.app')
@section('page', $page_title)
@section('padre', 'Vehiculos')
	@section('head')
	<!-- DATA TABLES -->
	{!! Html::style('admin-lte/plugins/datatables/dataTables.bootstrap.css') !!} 

	@endsection
@section('content')
<!-- Main content -->
		
        <section class="content">
          <div class="row">
            <div class="col-xs-10 col-md-8 col-md-offset-2">             

            @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-car text-light-blue"></i> Vehiculos Publicados Inactivos</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-car"></i> Total de Vehiculos Publicados: <b>{{count($vehiculos)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                        <th class="text-center"><i class="fa fa-user-plus"></i> Usuario</th>
                        <th class="text-center"><i class="fa fa-car"></i> Tipo</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Clasificación</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Marca</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Modelo</th>                        
                        <th class="text-center"><i class="fa fa-flag"></i> Pais</th>                        
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($vehiculos as $vehiculo)                      
                    <tr class="text-center">                                       
                    <td>{{$vehiculo->name}}</td>
                    <td>{{$vehiculo->tipo_vehiculo}}</td>  
                    <td>{{$vehiculo->clasificacion}}</td>                    
                    <td>{{$vehiculo->marca}}</td>
                    <td>{{$vehiculo->modelo}}</td>                   
                    <td>{{$vehiculo->pais}}</td>                                          
                      <td>
                        <div class="btn-group">
                                
                                <a class="btn btn-info btn-flat" href="{{route('vehicles.show',$vehiculo->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                                <a class="btn bg-purple btn-flat" href="#" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>      
                                <a class="btn btn-danger btn-flat" href="#" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-close"></i></a>                         
                          </div>
                      </td> 
                                      
                  </tr>
                  @endforeach
                    </tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@endsection
@section('footer')
	<!-- DATA TABES SCRIPT -->
	{!! Html::script('admin-lte/plugins/datatables/jquery.dataTables.min.js') !!} 
	{!! Html::script('admin-lte/plugins/datatables/dataTables.bootstrap.min.js') !!}
	<!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        
      });
    </script>
@endsection