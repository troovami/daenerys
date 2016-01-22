@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
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
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> {{$page_title}} Administrador</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                {!! Form::open(['route' => 'admin.create', 'class' => 'form']) !!}                       
                        @include('admin/forms/adm_form')
                        <div class="form-group col-md-4 col-md-push-8">
                            {!! Form::submit('Agregar',['class' => 'btn btn-success btn-block']) !!}
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
@endsection