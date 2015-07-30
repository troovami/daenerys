@extends('template.app')
@section('page', $page_title)
@section('padre', 'Personas')
	@section('head')
	<!-- DATA TABLES -->
	{!! Html::style('admin-lte/plugins/datatables/dataTables.bootstrap.css') !!} 
	@endsection
@section('content')
<!-- Main content -->
		
        <section class="content">
          <div class="row">
            <div class="col-xs-12 col-md-12">             

            @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-users text-light-blue"></i> All Personas</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-users"></i> Total de Personas: <b>{{count($personas)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <!--<th class="text-center"><i class="fa fa-certificate"></i></th>-->
                        <th class="text-center"><i class="fa fa-ban"></i> Estado</th>
                        <th class="text-center"><i class="fa fa-lock"></i> Password</th>
                        <th class="text-center"><i class="fa fa-certificate"></i> Certificado</th>
                        <th class="text-center"><i class="fa fa-user"></i> Usuario</th>
                        <th class="text-center"><i class="fa fa-file-text-o"></i> Nombre Completo</th>
                        <th class="text-center"><i class="fa fa-envelope-o"></i> Correo</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($personas as $persona)                      
			            <tr class="text-center">
				            @if ($persona->bol_eliminado == FALSE)
				            <td><span class="label label-success" >ENABLED</span></td>
				            @else
				            <td><span class="label label-default">DISABLED</span></td>
				            @endif
				            @if ($persona->password == '')
				            <td><i class="fa fa-close text-center text-danger"></i></td>
				            @else
				            <td><i class="fa fa-check text-center text-success"></i></td>
				            @endif
				            @if ($persona->bol_certificado == NULL)
				            <td><i class="fa fa-close text-center text-danger"></i></td>
				            @else
				            <td><i class="fa fa-check text-center text-success"></i></td>
				            @endif
				            <td>{{$persona->name}}</td>	
				            <td>{{$persona->str_nombre}}, {{$persona->str_apellido}}</td>
				            <td>{{$persona->email}}</td>  
				            <td>
				            	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="{{route('persona.edit',$persona->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="{{route('persona.show',$persona->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn bg-purple btn-flat" href="{{route('persona.status',$persona->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                          <a class="btn btn-danger btn-flat" href="{{route('persona.delete',$persona->id)}}" title="Eliminar"><i class="fa fa-user-times"></i></a>
			                          <a class="btn btn-default btn-flat" href="{{route('persona.reset',$persona->id)}}" title="Resetar Password"><i class="fa fa-eraser"></i></a>
			                          <a class="btn btn-primary btn-flat" href="{{route('persona.generate',$persona->id)}}" title="Generar Password"><i class="fa fa-shield"></i></a>
                                <a class="btn btn-success btn-flat" href="{{route('persona.certificate',$persona->id)}}" title="Cambiar Estado del Certificado"><i class="fa fa-certificate"></i></a>

			                    </div>
				            </td>          
			            </tr>
			            @endforeach
                    </tbody>
                    <!--<tfoot>
                      <tr>
                        <th class="text-center"><i class="fa fa-certificate"></i></th>
			            <th class="text-center"><i class="fa fa-user-secret"></i> Usuario</th>
			            <th class="text-center"><i class="fa fa-file-text-o"></i> Nombre Completo</th>
			            <th class="text-center"><i class="fa fa-envelope-o"></i> Correo</th>
			            <th class="text-center"><i class="fa fa-phone"></i> Teléfono</th>
			            <th class="text-center"><i class="fa fa-clock-o"></i> Fecha de Creación</th>
			            <th class="text-center"><i class="fa fa-cog"></i> Operación</th>
                      </tr>
                    </tfoot>-->
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