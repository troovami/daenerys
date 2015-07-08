@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<section class="content">
            <div class="col-md-10 col-md-offset-1">
              <div class="box box-default box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-users text-light-blue"></i> All Admins</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
</section>
@endsection