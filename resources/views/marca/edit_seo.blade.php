@extends('template.app')
@section('page', $page_title)
@section('padre', 'Marcas')
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
               
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-globe text-yellow"></i> {{$page_title}} Tipos Asociados &laquo; <img style="width:40px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" /> &raquo;  {{$marca->str_marca}}</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                {!! Form::model($marca,['route'=>['marca.update_seo',$marca->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}         			                                        
                    
                        
                        @foreach($tipos as $tipo)   
                            <div class="form-group col-md-12">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                    <h3 class="panel-title">{{$tipo->str_descripcion}}</h3>
                                    </div>
                                    <div class="panel-body">
                                        {!! Form::hidden("id_tipo[]",$tipo->id_tipo) !!}
                                        <div class="form-group col-md-12">
                                            <label>Meta Descripción</label>
                                            {!! Form::textarea("str_meta_descripcion[$tipo->id_tipo]", $tipo->str_meta_descripcion, ['class'=> 'form-control','rows'=> '3']) !!}
                                        </div> 
                                        <div class="form-group col-md-12">
                                            <label>Meta Keywords</label>   
                                            {!! Form::input('text', "str_meta_keyword[$tipo->id_tipo]", $tipo->str_meta_keyword, ['class'=> 'form-control']) !!}
                                        </div> 
                                    </div>
                                </div>                                                        
                            </div>
                        @endforeach                                                        
                    <div class="form-group col-md-6 col-md-push-6">
                    <br>
                    {!! Form::button('<i class="fa fa-pencil"></i> Editar', array('class'=>'btn btn-warning btn-block', 'type'=>'submit')) !!}
                    </div>    
                </div>                       
        			
        		{!! Form::close() !!} 
        		              
                <!-- form end -->
                </div>
              </div><!-- /.box -->            
        </div>
        <!-- col-md-8 col-md-offset-2 -->
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