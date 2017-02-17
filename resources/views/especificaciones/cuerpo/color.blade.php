@extends('template.app')
@section('page', $page_title)
@section('padre', 'Color')
	@section('head')
	<!-- DATA TABLES -->
	{!! Html::style('admin-lte/plugins/datatables/dataTables.bootstrap.css') !!} 

	@endsection
@section('content')
<!-- Main content -->
		
        <section class="content">
          <div class="row">
          <!--
          <div class="col-md-12">
            <button class="btn btn-lg btn-success" onclick="prueba('100','200')">Ajax</button>
          </div>                  
          -->

            <div class="col-xs-10 col-md-8 col-md-offset-2"> 
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Color <small>Total: {{ $total }}</small></h3>
                  <div class="btn-group pull-right" role="group" aria-label="...">                 
                      @for ($i = 0; $i < count($filtro); $i++)
                        @if ($i == 0) 
                        <button type="button" class="btn btn-default" onclick="filtro({{$filtro[$i]['skip']}})">&laquo;</button>                                                                     
                        @endif
                        <button type="button" class="btn btn-default" onclick="filtro({{$filtro[$i]['skip']}})">{{$filtro[$i]['numeracion']}}</button>                        
                        <!-- {{$fin = count($filtro)-1}} -->
                        @if ($i == $fin) 
                        <button type="button" class="btn btn-default" onclick="filtro({{$filtro[$i]['skip']}})">&raquo;</button>                        
                        @endif
                    @endfor                                    
                  </div>
                  <div class="col-md-12">
                    <form action="">
                      <div class="row">  
                      <div class="col-lg-7 col-md-push-5">
                        <div class="row">
                        </div> 
                        <br>                       
                      </div><!-- /.col-lg-6 -->
                      </div><!-- /.row -->
                    </form>                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="ajax">    

                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-center" style="width: 20%">#</th>
                      <th class="text-center" style="width: 20%">Color</th>
                      <th class="text-center" style="width: 15%">Nombre del Color</th>
                      <th class="text-center" style="width: 10%">Estatus</th>
                      <th class="text-center" style="width: 35%">Operaciones</th>
                    </tr>
                    <!--{{$k = 1}}-->
                    @foreach($color as $col)                      
                    <tr class="text-center">                   
                    
                    <td style="padding-top:20px;">{{ $k++ }}</td>
                    <td style="padding-top:20px;"><a style="background:{{$col->str_caracteristica}};height: 25px;width: 25px;margin-left: 15px;border: 10px inset {{$col->str_caracteristica}}"></a></td>
                    <td style="padding-top:20px;">{{$col->str_descripcion}}</td>                                        
                    @if ($col->bol_eliminado == 0)
                      <td style="padding-top:20px;"><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td style="padding-top:20px;"><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif                                            
                      <td style="padding-top:15px;">
                        <div class="btn-group">
                                <a class="btn btn-warning btn-flat" href="{{route('cuerpo.edit_color',$col->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-info btn-flat" href="{{route('cuerpo.show_color',$col->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                                <a class="btn bg-purple btn-flat" href="{{route('cuerpo.status_color',$col->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>     
                                <a class="btn btn-danger btn-flat" href="{{route('cuerpo.delete_color',$col->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
                                
                          </div>
                      </td> 
                                      
                  </tr>
                  @endforeach
                    
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">                   
                  <div class="btn-group pull-right" role="group" aria-label="...">                 
                      @for ($i = 0; $i < count($filtro); $i++)
                        @if ($i == 0) 
                        <button type="button" class="btn btn-default" onclick="filtro({{$filtro[$i]['skip']}})">&laquo;</button>                                                                     
                        @endif
                        <button type="button" class="btn btn-default" onclick="filtro({{$filtro[$i]['skip']}})">{{$filtro[$i]['numeracion']}}</button>                        
                        <!-- {{$fin = count($filtro)-1}} -->
                        @if ($i == $fin) 
                        <button type="button" class="btn btn-default" onclick="filtro({{$filtro[$i]['skip']}})">&raquo;</button>                        
                        @endif
                    @endfor                                    
                  </div>
              </div><!-- /.box -->

            @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              
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