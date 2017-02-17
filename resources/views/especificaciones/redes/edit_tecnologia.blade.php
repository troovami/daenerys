@extends('template.app')
@section('page', $page_title)
@section('padre', 'Tecnología')
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
                  <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i>Tecnología</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                {!! Form::model($tecnologia,['route'=>['redes.update_tecnologia',$tecnologia->id],'method'=>'PUT']) !!}
                    <div class="form-group col-md-12">
                            <label>Nombre de la Tecnologí</label>
                            {!! Form::input('text', 'str_especificaciones', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-12">
                            <label>Descripción de la Tecnología</label>
                            {!! Form::input('text', 'str_description', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-4 col-md-push-4">
                    <br>
                    {!! Form::button('<i class="fa fa-pencil"></i> Editar', array('class'=>'btn btn-warning btn-block', 'type'=>'submit')) !!}
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
  
@endsection
@endsection