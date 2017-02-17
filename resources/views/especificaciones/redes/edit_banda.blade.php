@extends('template.app')
@section('page', $page_title)
@section('padre', 'Banda')
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
                  <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i>Banda</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                {!! Form::model($banda,['route'=>['redes.update_banda',$banda->id],'method'=>'PUT']) !!}
                    <div class="form-group col-md-12">
                            <label>Frecuencia de la Banda</label>
                            {!! Form::input('text', 'str_frecuecia', null, ['class'=> 'form-control']) !!}
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