@extends('template.app')
@section('page', $page_title)
@section('padre', 'Operadoras')
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
                  <h3 class="box-title">Operadoras <small>Total: {{ $total }}</small></h3>
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
                          <!--<br>
                          <div class="input-group">                            
                            <input id="brandSearchInput" onkeyup="brandSearch();" type="text" class="form-control" placeholder="Buscar Sistema Operativo...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                          </div>-->
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
                      <th class="text-center" style="width: 25%">Operadora</th>
                      <!--<th class="text-center" style="width: 15%">País</th>-->
                      <th class="text-center" style="width: 10%">Estatus</th>
                      <th class="text-center" style="width: 45%">Operaciones</th>
                    </tr>
                    <!--{{$k = 1}}-->
                    @foreach($operadoras as $opera)                      
                    <tr class="text-center">                   
                    
                    <td style="padding-top:20px;">{{ $k++ }}</td>
                     @if ($opera->logo == null)
                    <td><img style="width:50px;" src="{{ asset('images/troovami-logo-online.png') }}" /><br> {{$opera->str_operadora}}</td>
                    @else
                    <td> <img style="width:50px;" src="data:{{$opera->format}};base64,{{$opera->logo}}" /><br> {{$opera->str_operadora}}</td>
                    @endif 
                   
                    @if ($opera->bol_eliminado == 0)
                      <td style="padding-top:20px;"><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td style="padding-top:20px;"><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif                                            
                      <td style="padding-top:15px;">
                        <div class="btn-group">
                                <a class="btn btn-warning btn-flat" href="{{route('redes.edit_operadora',$opera->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-info btn-flat" href="{{route('redes.show_operadora',$opera->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                                <a class="btn bg-purple btn-flat" href="{{route('redes.status_operadora',$opera->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>     
                                <a class="btn btn-danger btn-flat" href="{{route('redes.delete_operadora',$opera->id)}}" title="Eliminar"><i class="fa fa-close"></i></a>
                                
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