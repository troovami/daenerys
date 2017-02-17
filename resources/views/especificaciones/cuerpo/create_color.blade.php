@extends('template.app')
@section('page', $page_title)
@section('padre', 'Color')
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
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> Color</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">                 
                {!! Form::open(['route' => 'cuerpo.create_color', 'class' => 'form']) !!}
                    <div>
                    <!-- Color Pick -->
                    </div>
                    <div class="form-group col-md-12">
                            <label>Nombre del Color</label>
                            {!! Form::input('text', 'str_descripcion', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-12">
                            <label>Codigo Hexadecimal</label>
                            {!! Form::input('text', 'str_caracteristica', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-4 col-md-push-4">
                        <br>
                        {!! Form::submit('Agregar',['class' => 'btn btn-success btn-block','name' => 'boton']) !!}
                        

                    </div>
                        
                {!! Form::close() !!}
                <p id="demo"></p>
                <!-- form end -->
                </div>
              </div><!-- /.box -->            
        </div>
        <!-- col-md-4 col-md-offset-4 -->
    </div>
    <!-- .row -->
</div>
 
@section('footer')
    
@endsection
@endsection

<!---->