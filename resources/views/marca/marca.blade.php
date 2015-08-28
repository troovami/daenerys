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
                  <h3 class="box-title">Marcas <small>Total: {{ $total }}</small></h3>
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
                      <div class="col-lg-6 col-md-push-6">
                        <div class="row">
                          <br>
                          <div class="input-group">                            
                            <input type="text" class="form-control" placeholder="Buscar Marcas...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                          </div><!-- /input-group -->
                          <div style="background-color:#CCC; position:absolute; z-index:1;float:left">
                          <table class="table table-bordered" style="width: 100%;">
                            <tr>
                              <th class="text-center" style="width: 10%">#</th>
                              <th class="text-center" style="width: 20%">Logo</th>
                              <th class="text-center" style="width: 30%">Marca</th>
                              <th class="text-center" style="width: 10%"><i class="fa fa-circle-o"></i></th>
                              <th class="text-center" style="width: 35%"><i class="fa fa-cog"></i></th>
                            </tr>
                            <tr class="text-center"> 
                              <td style="padding-top:20px;">1</td>
                              <td><img style="width:50px;" src="{{ asset('images/troovami-logo-online.png') }}" /></td>
                              <td style="padding-top:20px;">Troovami</td>
                              <td style="padding-top:20px;"><span class="label label-success"><i class="fa fa-check"></i></span></td>
                              <td style="padding-top:15px;">
                                <!-- Single button -->
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                  </ul>
                                </div>
                              </td>
                            </tr>
                          </table>   
                          
                        </div>                        
                      </div><!-- /.col-lg-6 -->
                      </div><!-- /.row -->
                    </form>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="ajax">
                  <table class="table table-bordered">
                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-center" style="width: 20%">Logo</th>
                      <th class="text-center" style="width: 30%">Marca</th>
                      <th class="text-center" style="width: 10%">Progress</th>
                      <th class="text-center" style="width: 35%">Label</th>
                    </tr>
                    <!--{{$k = 1}}-->
                    @foreach($marcas as $marca)                      
                    <tr class="text-center">                   
                    
                    <td style="padding-top:20px;">{{ $k++ }}</td>
                    @if ($marca->blb_img == null)
                    <td><img style="width:50px;" src="{{ asset('images/troovami-logo-online.png') }}" /></td>
                    @else
                    <td><img style="width:50px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" /></td>
                    @endif  
                    <td style="padding-top:20px;">{{$marca->str_marca}}</td>                                        
                    @if ($marca->bol_eliminado == 0)
                      <td style="padding-top:20px;"><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td style="padding-top:20px;"><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif                                            
                      <td style="padding-top:15px;">
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