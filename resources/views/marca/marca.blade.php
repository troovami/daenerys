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
          <!--
          <div class="col-md-12">
            <button class="btn btn-lg btn-success" onclick="prueba('100','200')">Ajax</button>
          </div>                  
          -->

            <div class="col-xs-10 col-md-8 col-md-offset-2"> 
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Marcas <small>Total: {{ $filtro['countMarcas'] }}</small></h3>
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="{{route('marca.index')}}">&laquo;</a></li>                    
                    <?php
                    //echo $filtro['filtroMarcas'];
                    //echo $filtro['countMarcas'];
                    
                      $i = 0;   
                      $k = 1; 
                      $c = 0;            
                    
                    // $filtro['countMarcas'] = Todas las Marcas
                    // $filtro['filtroMarcas'] = 50
                    while ($i<$filtro['countMarcas']) {
                      $i = $i + $filtro['filtroMarcas'];
                      if($i>=$contador){
                        $c = $filtro['countMarcas'] - $filtro['filtroMarcas'];
                        echo '<li><a href="#" onclick="filtro('. $c .')">'. $k++ .'</a></li>';

                        //echo '<li><a href="#" onclick="filtro('. $c .','. $contador .')">'. $k++ .'</a></li>';
                      }else{
                        $c = $i - $filtro['filtroMarcas'];
                        echo '<li><a href="'. $i .'" onclick="filtro('. $c .')">'. $k++ .'</a></li>';
                        //echo '<li><a href="#" onclick="filtro('. $c .','. $i .')">'. $k++ .'</a></li>';                       
                      } 
                      
  
                    }
                    
                    ?>
                    <!--
                    <li><a href="#"></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">3</a></li>
                    -->
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div><!-- /.box-header -->
                <div class="box-body" id="ajax">
                  <table class="table table-bordered">
                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-center" style="width: 30%">Marca</th>
                      <th class="text-center" style="width: 30%">Progress</th>
                      <th class="text-center" style="width: 35%">Label</th>
                    </tr>
                    <!--{{$k = 1}}-->
                    @foreach($marcas as $marca)                      
                    <tr class="text-center">                   
                    
                    <td>{{ $k++ }}</td>
                    <td>{{$marca->str_marca}}</td>                                        
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
                                <a class="btn btn-success btn-flat" href="{{route('marca.edit_seo',$marca->id)}}" title="SEO Tipos Asociados"><i class="fa fa-globe"></i></a>                         

                          </div>
                      </td> 
                                      
                  </tr>
                  @endforeach
                    
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
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