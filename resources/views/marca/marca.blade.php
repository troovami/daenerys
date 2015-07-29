@extends('template.app')
@section('page', $page_title)
@section('padre', 'Marcas')
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
                  <h3 class="box-title"><i class="fa fa-flag text-light-blue"></i> All Marcas</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-users"></i> Total de Marcas: <b>{{count($marcas)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                        <th class="text-center"><i class="fa fa-flag"></i> Logo</th>
                        <th class="text-center"><i class="fa fa-file-text-o"></i> Marca</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Tipo</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Estado</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($marcas as $marca)                      
			              <tr class="text-center">                   
                    <td>
                      @if($marca->blb_img==NULL)
                        <i class="fa fa-flag text-red"></i>
                      @else
                        <img class="img-rounded" style="width:100px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" />
                      @endif                        
                    </td>
                    <td>{{$marca->str_marca}}</td>                    
                    <td>{{$marca->str_descripcion}}</td>
			            	@if ($marca->bol_eliminado == 0)
                      <td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif			                			                
			                <td>
			                	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="{{route('marca.edit',$marca->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="{{route('marca.show',$marca->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn bg-purple btn-flat" href="{{route('marca.status',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>			
                                <a class="btn btn-danger btn-flat" href="{{route('marca.delete',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-close"></i></a>                         
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