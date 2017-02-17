@extends('template.app')
@section('page', $page_title)
@section('padre', 'Modelo')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
    		    <div class="alert alert-danger">
    		        <ul>
    		            @foreach ($errors->all() as $error)
    		                <li>{{ $error }}</li>
    		            @endforeach
    		        </ul>
    		    </div>
    		@endif
		
            @if(Session::has('message'))

            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif
                
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> {{$page_title}} Modelo</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                {!! Form::open(['route' => 'modelo.create', 'class' => 'form','enctype'=>'multipart/form-data']) !!}
                    <div class="panel-body">
                        <div class="form-group col-md-6">
                            <label>Marca</label> 
                            {!! Form::select('lng_idmarca', 
                                                ([null=>'Indique una Marca Ej: Blu'] + $marcas), 
                                                null, 
                                                ['class' => 'form-control select2','id'=>'marca','onchange'=>'','required'=>'','style'=>'width: 304px;!important']
                                            ) 
                            !!} 

                    </div>  
                    <div class="form-group col-md-6">
                        <label>Tipo de Equipo</label><br>
                        {!! Form::select('lng_idclasificacion', 
                                                ([null=>'Indique un tipo de equipo Ej: Movil'] + $clasificacion), 
                                                null, 
                                                ['class' => 'form-group select2','id'=>'lng_idclasificacion','name'=>'lng_idclasificacion','onchange'=>'','required'=>'','style'=>'width: 304px;!important']
                                            ) 
                        !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gama</label><br>
                        {!! Form::select('lng_idgama', 
                                                ([null=>'Indique una gama Ej: Alta'] + $gama), 
                                                null, 
                                                ['class' => 'form-group select2','id'=>'lng_idgama','name'=>'lng_idgama','onchange'=>'','required'=>'','style'=>'width: 304px;!important']
                                            ) 
                        !!}
                    </div>
                    <div class="form-group col-md-6">
                            <label>Modelo</label>
                            {!! Form::input('text', 'str_modelo', null, ['class'=> 'form-control']) !!}
                    </div>                                               
                    <div class="form-group col-md-4">
                        {!! Form::submit('Agregar',['class' => 'btn btn-success btn-block']) !!}
                    </div>
                {!! Form::close() !!}
                <!-- form end -->
                </div>
              </div><!-- /.box -->            
        </div>
        <!-- col-md-4 col-md-offset-4 -->
    </div>
    <!-- .row -->
</div>
@section('footer')
    <!-- Select2 -->
    {!! Html::script('admin-lte/plugins/select2/select2.full.min.js') !!}

    <script type="text/javascript">
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
@endsection
@endsection