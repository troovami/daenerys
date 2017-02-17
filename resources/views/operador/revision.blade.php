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
            <div class="" style="margin:25px;">             

            @if(Session::has('message'))

            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              <div class="box" style="padding:20px;">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-car text-light-blue"></i> Publicaciones en Revisión</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-car"></i> Total de Publiaciones en Revisión: <b>{{count($revisiones)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                        <th class="text-center"><i class="fa fa-user-plus"></i> Usuario</th>
                        <th class="text-center"><i class="fa fa-car"></i> Tipo</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Clasificación</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Marca</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Modelo</th>                        
                        <th class="text-center"><i class="fa fa-flag"></i> Pais</th>  
                        <th class="text-center"><i class="fa fa-user-secret"></i> Supervisor</th>                          
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($revisiones as $revision)                      
			              <tr class="text-center">                                       
                    <td>{{$revision->name}}</td>
                    <td>{{$revision->tipo_vehiculo}}</td>  
                    <td>{{$revision->clasificacion}}</td>                    
                    <td>{{$revision->marca}}</td>
                    <td>{{$revision->modelo}}</td>                   
			            	<td>{{$revision->pais}}</td>
			            	<td>{{$revision->admin}}</td>  		                			                
			                <td>
			                	<div class="btn-group">
			                	<a class="btn btn-info btn-flat" href="{{route('operador.detalle',$revision->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
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