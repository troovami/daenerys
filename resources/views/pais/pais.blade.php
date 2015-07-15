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
            <div class="col-xs-12 col-md-12">             

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
                        <!--<th class="text-center"><i class="fa fa-certificate"></i></th>-->
                        <th class="text-center"><i class="fa fa-ban"></i> Bandera</th>
                        <th class="text-center"><i class="fa fa-ban"></i> Paises</th>
                        <th class="text-center"><i class="fa fa-ban"></i> Estado</th>
                        <th class="text-center"><i class="fa fa-ban"></i> Operaciones</th>
                        
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($paises as $pais)                      
			            <tr class="text-center">

			            	<td><img src="@include('pais.flag', ['blob' => $pais->blb_img])" alt="{{$pais->str_paises}}"></td>
			            	<td>{{$pais->str_paises}}</td>
			                <td>{{$pais->blb_img}}</td>			                
			                <td>
			                	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="#" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn bg-purple btn-flat" href="#" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>			                          
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