@extends('template.app')
@section('page', $page_title)
@section('padre', 'Paises')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
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
                  <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i> {{$page_title}} Pais &laquo; <img style="width:40px;" src="data:{{$pais->format}};base64,{{$pais->blb_img}}" /> &raquo;  {{$pais->str_paises}}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                {!! Form::model($pais,['route'=>['pais.update',$pais->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}                
                    <div class="form-group col-md-12">
                            <label>País</label>
                            {!! Form::input('text', 'str_paises', null, ['class'=> 'form-control']) !!}
                    </div>                                               
                    <div class="form-group col-md-12">
                            <label>Bandera</label>
                            {!! Form::file('blb_img') !!}                            
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::button('<i class="fa fa-pencil"></i> Editar', array('class'=>'btn btn-warning btn-block', 'type'=>'submit')) !!}
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
@endsection