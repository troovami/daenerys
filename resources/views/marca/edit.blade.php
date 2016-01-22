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
                  <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i> {{$page_title}} Marca &laquo; <img style="width:40px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" /> &raquo;  {{$marca->str_marca}}</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                {!! Form::model($marca,['route'=>['marca.update',$marca->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!} 
        			<div class="form-group col-md-6">
                            <label>Marca</label>
                            {!! Form::input('text', 'str_marca', null, ['class'=> 'form-control']) !!}
                    </div> 
                    <div class="form-group col-md-6">
                            <label>Imagen</label>
                            {!! Form::file('blb_img') !!}                            
                    </div>                    
                    <div class="form-group col-md-12">
                        <label>Tipo(s)</label>
                        <select name="lng_idtipo[]" id="hola" multiple="multiple" class="form-control select2" data-placeholder="Indique los Tipos Ej: Carros">
                        @for ($i = 0; $i < count($tipos); $i++)                                  
                            <option value="{{$tipos[$i]->id}}" {{$tipos[$i]->attrib}}>{{$tipos[$i]->str_descripcion}}</option>                        
                        @endfor                                
                        </select>
                    </div> 
                    <div class="form-group col-md-6">
                            <label>Friendly URL</label>
                            {!! Form::input('text', 'str_friendly_url', null, ['class'=> 'form-control']) !!}
                    </div>                   
                    <div class="form-group col-md-6">
                            <label>Website Ruta</label>
                            {!! Form::input('text', 'str_website', null, ['class'=> 'form-control']) !!}
                    </div>  
        			<div class="form-group col-md-6 col-md-push-6">
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