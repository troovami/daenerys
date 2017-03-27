@extends('template.app')
@section('page', $page_title)
@section('padre', 'Telefonos - Operadoras')
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
                <h3 class="box-title"><i class="fa fa-plus-square text-green"></i> Telefono - Operadora</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                
                {!! Form::open(['route' => 'telefono.create_operadora', 'class' => 'form']) !!}
                <div class="form-group col-md-12">
                      <label for="disabledTextInput">Telefono</label>
                      <input class="form-control" type="text" placeholder="{{$telefono->str_version}}" readonly>
                      <input type="hidden" name="lng_idversion_modelo" value="{{$telefono->id}}">
                </div>
                <div class="form-group col-md-12">
                        <label>Operadora(s)</label>
                        <select name="lng_frec_tecno_oper" id="lng_frec_tecno_oper" class ="form-group select2" style="width: 100%;!important">
                            <option>Seleccione una Operadora</option>
                            @foreach($operadoras as $oper)
                            <option value="{{$oper->id}}">{{$oper->tecnologia_full}}</option>
                            @endforeach
                        </select>
                        
                </div> 
                <div class="form-group col-md-12">
                    <br>
                    {!! Form::button('<i class="fa fa-pencil"></i> Agregar', array('class'=>'btn btn-success btn-block', 'type'=>'submit')) !!}
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