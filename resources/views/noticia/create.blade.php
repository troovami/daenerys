@extends('template.app')
@section('page', $page_title)
@section('padre', 'Noticia')
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
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> {{$page_title}} Noticia</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                {!! Form::open(['route' => 'noticia.create', 'class' => 'form','files'=>true,'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group col-md-12">
                            <label>Titulo</label>
                            {!! Form::input('text', 'str_titulo', null, ['class'=> 'form-control']) !!}
                    </div>   
                    <div class="form-group col-md-12">
                            <label>Contenido</label>
                           {!! Form::textarea('str_contenido', '', ['id' => 'str_contenido', 'class'=> 'ckeditor','required','placeholder'=>'']) !!}
                    </div>     
                    <div class="form-group col-md-12">
                            <label>Imagen</label>
                            <input type="hidden" name="int_peso" id="int_peso" value=1>
                           {!! Form::file('blb_img') !!}  
                    </div>                                        
                    <div class="form-group col-md-12">
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
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
@endsection
@endsection