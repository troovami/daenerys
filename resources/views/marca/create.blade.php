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
                
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> {{$page_title}} Marca</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                {!! Form::open(['route' => 'marca.create', 'class' => 'form','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group col-md-6">
                            <label>Marca</label>
                            {!! Form::input('text', 'str_marca', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-6">
                            <label>Tipo</label>
                            
                            {!! Form::select('lng_idtipo', 
                                                (['' => 'Seleccione'] + $tipo), 
                                                null, 
                                                ['class' => 'form-control']
                                            ) 
                            !!} 
                            
                    </div>                                                                  
                    <div class="form-group col-md-6">
                            <label>Imagen</label>
                            {!! Form::file('blb_img') !!}                            
                    </div>
                    
                    <div class="form-group col-md-6">
                            <label>Friendly URL</label>
                            {!! Form::input('text', 'str_friendly_url', null, ['class'=> 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-12">
                            <label>Meta Description</label>
                            {!! Form::textarea('str_meta_descripcion', null, ['class'=> 'form-control','rows'=> '3']) !!}
                    </div>
                    <div class="form-group col-md-6">
                            <label>Meta Keyword</label>
                            {!! Form::input('text', 'str_meta_keyword', null, ['class'=> 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-6">
                            <label>Website Ruta</label>
                            {!! Form::input('text', 'str_website', null, ['class'=> 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-6 col-md-push-6">
                        <br>
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
@endsection