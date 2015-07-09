@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
	@section('head')
	<!-- DATA TABLES -->
	{!! Html::style('admin-lte/plugins/datatables/dataTables.bootstrap.css') !!} 
	@endsection
@section('content')
<!--
<section class="content">
            <div class="col-md-10 col-md-offset-1">
              <div class="box box-default box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-users text-light-blue"></i> All Admins</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table table-bordered table-striped">
			        <thead>            
			            <tr>
			            	<th class="text-center"><i class="fa fa-certificate"></i></th>
			                <th class="text-center"><i class="fa fa-user-secret"></i> Usuario</th>
			                <th class="text-center"><i class="fa fa-file-text-o"></i> Nombre Completo</th>
			                <th class="text-center"><i class="fa fa-envelope-o"></i> Correo</th>
			                <th class="text-center"><i class="fa fa-phone"></i> Teléfono</th>
			                <th class="text-center"><i class="fa fa-clock-o"></i> Fecha de Creación</th>
			                <th class="text-center"><i class="fa fa-cog"></i> Operación</th>
			            </tr>
			        </thead>
			        <tbody>
			        <p><i class="fa fa-users text-light-blue"></i> Total de Administradores: <b>{{count($users)}}</b></p>			        
			           @foreach($users as $user)
			            <tr class="text-center">
			            	<td>{{$user->id}}</td>
			                <td>{{$user->name}}</td>
			                <td>{{$user->str_nombre}}, {{$user->str_apellido}}</td>
			                <td>{{$user->email}}</td>
			                <td>{{$user->str_telefono}}</td>
			                <td>{{$user->created_at}}</td>
			                <td>
			                	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="{{route('admin.edit',$user->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="#" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn btn-danger btn-flat" href="#" title="Desactivar"><i class="fa fa-user-times"></i></a>
			                    </div>
			                </td>
			                
			            </tr>
			            @endforeach
			        </tbody>
    			</table>
                </div>
              </div>
            </div>

</section>
-->
<!-- Main content -->
		
        <section class="content">
          <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">             

            @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-users text-light-blue"></i> All Admins</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-users"></i> Total de Administradores: <b>{{count($users)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center"><i class="fa fa-certificate"></i></th>
			            <th class="text-center"><i class="fa fa-user-secret"></i> Usuario</th>
			            <th class="text-center"><i class="fa fa-file-text-o"></i> Nombre Completo</th>
			            <th class="text-center"><i class="fa fa-envelope-o"></i> Correo</th>
			            <th class="text-center"><i class="fa fa-phone"></i> Teléfono</th>
			            <th class="text-center"><i class="fa fa-clock-o"></i> Fecha de Creación</th>
			            <th class="text-center"><i class="fa fa-cog"></i> Operación</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($users as $user)
			            <tr class="text-center">
			            	<td>{{$user->id}}</td>
			                <td>{{$user->name}}</td>
			                <td>{{$user->str_nombre}}, {{$user->str_apellido}}</td>
			                <td>{{$user->email}}</td>
			                <td>{{$user->str_telefono}}</td>
			                <td>{{$user->created_at}}</td>
			                <td>
			                	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="{{route('admin.edit',$user->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="{{route('admin.show',$user->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn bg-purple btn-flat" href="{{route('admin.status',$user->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>
			                          <a class="btn btn-danger btn-flat" href="{{route('admin.delete',$user->id)}}" title="Eliminar"><i class="fa fa-user-times"></i></a>

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