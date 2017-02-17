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
                  <h3 class="box-title"><i class="fa fa-flag text-light-blue"></i>Marcas Asociadas a Móviles</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class="fa fa-users"></i> Total de Marcas: <b>{{count($marcas)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                        <th class="text-center"><i class="fa fa-image"></i> Logo</th>
                        <th class="text-center"><i class="fa fa-bullseye"></i> Marca</th>                        
                        <th class="text-center"><i class="fa fa-ban"></i> Estado</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                      </tr>
                    </thead>
                    <tbody>                    
                      @foreach($marcas as $marca)                      
			              <tr class="text-center">                   
                    <td>
                      @if($marca->blb_img==NULL)
                        <img class="img-rounded" alt="empty" title="Sin Logo" style="width:100px;" src="{{ asset('images/troovami-logo-offline.png') }}" />
                      @else
                        <img class="img-rounded" alt="{{$marca->str_marca}}" title="{{$marca->str_marca}}" style="width:100px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" />
                      @endif                        
                    </td>
                    <td style="padding-top:4%"><h4>{{$marca->str_marca}}</h4></td>                    
                    <!--<td>TIPO</td>-->
			            	@if ($marca->bol_eliminado == 0)
                      <td style="padding-top:4%"><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td style="padding-top:4%"><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif			                			                
			                <td style="padding-top:4%">
			                	<div class="btn-group">
			                          <a class="btn btn-warning btn-flat" href="{{route('marca.edit',$marca->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
			                          <a class="btn btn-info btn-flat" href="{{route('marca.show',$marca->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
			                          <a class="btn bg-purple btn-flat" href="{{route('marca.status',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>			
                                <a class="btn btn-danger btn-flat" href="{{route('marca.delete',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-close"></i></a>
                                <a class="btn btn-success btn-flat" href="{{route('marca.edit_seo',$marca->id)}}" title="SEO Tipos Asociados"><i class="fa fa-globe"></i></a>                         
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