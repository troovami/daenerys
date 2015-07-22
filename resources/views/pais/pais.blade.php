@extends('template.app')
@section('page', $page_title)
@section('padre', 'Paises')
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
                  <h3 class="box-title"><i class="fa fa-flag text-light-blue"></i> All Paises</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-users"></i> Total de Paises: <b>{{count($paises)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                        <th class="text-center"><i class="fa fa-flag"></i> Bandera</th>
                        <th class="text-center"><i class="fa fa-file-text-o"></i> Paises</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Estado</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($paises as $pais)                      
			              <tr class="text-center">                   
                    <td>
                      @if($pais->blb_img==NULL)
                        <i class="fa fa-flag text-red"></i>
                      @else                      

                        <img class="img-rounded" style="width:100px;" src="data:{{$pais->format}};base64,{{$pais->blb_img}}" />
                      @endif                        
                    </td>

			            	<td>{{$pais->str_paises}}</td>			                			                
			                <td>
			                	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="{{route('pais.edit',$pais->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="{{route('pais.show',$pais->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn bg-purple btn-flat" href="{{route('pais.status',$pais->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>			
                                <a class="btn btn-danger btn-flat" href="{{route('pais.delete',$pais->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-close"></i></a>                         
			                    </div>
			                </td>	
                      @if ($pais->bol_eliminado == 0)
                      <td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif	            	
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