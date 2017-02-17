@extends('template.app')
@section('page', $page_title)
@section('padre', 'Operadoras')
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
                  <h3 class="box-title"><i class="fa fa-pencil text-yellow"></i> {{$page_title}} Operadora &laquo; <img style="width:40px;" src="data:{{$operadora->format}};base64,{{$operadora->blb_img}}" /> &raquo;  {{$operadora->str_operadora}}</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                 {!! Form::model($operadora,['route'=>['redes.update_operadora',$operadora->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
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
                        <select name="lng_idpais[]" id="hola" multiple="multiple" class="form-control select2" data-placeholder="Indique los Paises Ej: Venezuela">
                        @for ($i = 0; $i < count($paises); $i++)                                  
                            <option value="{{$paises[$i]->id}}" {{$paises[$i]->attrib}}>{{$paises[$i]->str_paises}}</option>                        
                        @endfor                                
                        </select>
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