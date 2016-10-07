@extends('template.app')
@section('page', $page_title)
@section('padre', 'Publicaciones')
	@section('head')
	<!-- DATA TABLES -->
	{!! Html::style('admin-lte/plugins/datatables/dataTables.bootstrap.css') !!} 

	@endsection
@section('content')
<!-- Main content -->
		
        <section class="content">
          <div class="row">
            <div class="" style="margin:25px;">             

            @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              <div class="box" style="padding:20px;">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-car text-light-blue"></i> Publicaciones</h3>

                </div><!-- /.box-header -->
               
                <div class="box-body">
                {!! Form::open(['route' => 'supervisor.publicaciones', 'id' => 'demo-form', 'class' => '', 'enctype'=>'multipart/form-data', 'onKeypress' => 'if(event.keyCode == 13) event.returnValue = false']) !!}<!-- /.Button Submit--->
                <p><i class="fa fa-car"></i> Total de Publicaciones: <b>{{count($publicaciones)}}</b></p>
                <div>
                            <label>Responsable</label>
                          	<select name="responsable" id="responsable" class="">
                         	<option value="">Seleccione</option>
      						@foreach($responsables as $responsable)
      						<option value="{{$responsable->id}}">{{$responsable->name}}</option>         
                          	@endforeach
                        	</select>                            
		         	</div>
                  <table id="example1" class="table table-bordered table-striped">
                  	<thead>
                      <tr>                        
                        <th class="text-center"><i class="fa fa-user-plus"></i> Usuario</th>
                        <th class="text-center"><i class="fa fa-car"></i> Tipo</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Clasificación</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Marca</th>
                        <th class="text-center"><i class="fa fa-circle"></i> Modelo</th>                        
                        <th class="text-center"><i class="fa fa-flag"></i> Pais</th>                        
                        <th class="text-center"><i class="fa fa-user"></i> Supervisor</th>
                        <th class="text-center"><i class="fa fa-user"></i> Responsable</th>
                        <th class="text-center"><i class="fa fa-cog"></i> Operaciones</th>
                        <th class="text-center"><input type="checkbox" onclick="marcar(this);" /> Selección</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    	$a = 0; 
                    ?>                    
                      @foreach($publicaciones as $publicacion)                      
			              <tr class="text-center">                                       
                    <td>{{$publicacion->name}}</td>
                    <td>{{$publicacion->tipo_vehiculo}}</td>  
                    <td>{{$publicacion->clasificacion}}</td>                    
                    <td>{{$publicacion->marca}}</td>
                    <td>{{$publicacion->modelo}}</td>                   
			        <td>{{$publicacion->pais}}</td> 
			        <td>{{$publicacion->admin}}</td> 
			        <td>{{$publicacion->oper}}</td> 
			        <td><div class="btn-group">
			             <a class="btn btn-info btn-flat" href="{{route('supervisor.detalle',$publicacion->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                         </div>
                    </td> 
                    <td>{!! Form::checkbox("publicacion[$a]", $publicacion->id) !!}</td>
			        <!--  <td><input type="checkbox" name="publicacion" id="publicacion<?=$a?>" value="{{$publicacion->id}}"></input></td> -->
			        <?php 
			            	$a++;
			        ?>
			            </tr>
			         @endforeach
                    </tbody>          
                  </table>
                  
	    			<div class="form-group col-md-3">
			        <label></label>
			        <button class ="btn btn-success btn-block" style="height:39px" type="submit">Asignar</button> 
	              	</div>
					 {!! Form::close() !!}
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
    <script>
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); 
		for(i=0;i<checkboxes.length;i++)
		{
			if(checkboxes[i].type == "checkbox")
			{
				checkboxes[i].checked=source.checked;
			}
		}
	}
</script>
@endsection