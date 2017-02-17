@extends('template.app')
@section('page', $page_title)
@section('padre', 'Operadora')
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
                  <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> Operadora</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                 
                {!! Form::open(['route' => 'redes.create_operadora', 'class' => 'form','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group col-md-12">
                            <label>Nombre de la Operadora</label>
                            {!! Form::input('text', 'str_operadora', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-12">
                            <label>Logo</label>
                            {!! Form::file('blb_img') !!}                            
                    </div>
                    <div class="form-group col-md-12">
                            <label>Paises(s)</label>                            
                            {!! Form::select('lng_idpais[]', 
                                                ($paises), 
                                                null, 
                                                ['class' => 'form-control select2',
                                                 'data-placeholder' => 'Indique un País Ej: Venezuela',
                                                 'multiple' => 'multiple']
                                            ) 
                            !!} 
                    </div>  
                     
                    <div class="form-group col-md-4">
                        <br>
                        {!! Form::submit('Agregar',['class' => 'btn btn-success btn-block','name' => 'boton']) !!}
                        

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