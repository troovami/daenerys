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
                  <h3 class="box-title"><i class="text-light-blue"></i> All Telefonos</h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                <p><i class=""></i> Total de Marcas: <b>{{count($telefonos)}}</b></p>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                        <th class="text-center"><i class=""></i> #</th>
                        <th class="text-center col-md-2"><i class=""></i> Marca</th>
                        <th class="text-center col-md-2"><i class=""></i> Modelo</th>
                        <th class="text-center col-md-2"><i class=""></i> Version</th>
                        <th class="text-center col-md-4"><i class="fa fa-cog"></i> Estado</th>
                        <th class="text-center col-md-4"><i class="fa fa-cog"></i> Operaciones</th>
                      </tr>
                    </thead>
                    <tbody> 
                     <!--{{$k = 1}}-->                   
                      @foreach($telefonos as $telefono)                      
                    <tr class="text-center">                   
                    <td style="padding-top:20px;">{{ $k++ }}</td>
                    <td style="padding-top:20px;">{{$telefono->marca}}</td>
                    <td style="padding-top:20px;">{{$telefono->modelo}}</td>  
                    <td style="padding-top:20px;">{{$telefono->version}}</td>                                          
                    @if ($telefono->bol_eliminado == 0)
                      <td style="padding-top:20px;"><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td style="padding-top:20px;"><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif                                            
                    <td>
                        <div class="btn-group">
                                <a class="btn btn-info btn-flat" href="{{route('telefono.show',$telefono->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                                <a class="btn btn-danger btn-flat" href="{{route('telefono.delete',$telefono->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
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