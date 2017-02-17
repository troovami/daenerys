@extends('template.app')
@section('page', $page_title)
@section('padre', 'SIM CARD')
@section('content')
<section class="content col-md-6 col-md-push-3">
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
          <div class="row">
            <div class="col-md-6">
             <h2 class="text-center">&laquo; {{$simcard->str_descripcion}} &raquo;</h2>
        </div>
            <div class="col-md-6">
              <div class="box box-purple">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-ban"></i>SIM CARD</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody>
            <tr>
            <th class="text-right">SIM CARD:</th>
            <td>{{$simcard->str_descripcion}}</td>
            </tr>
            <tr>
              <th class="text-right">Estado:</th>
              @if ($simcard->bol_eliminado == 0)
                <td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
              @else
                <td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
              @endif
            </tr>
            <tr>
              <th class="text-right">Accion:</th>
              <td>
                {!! Form::open(['route'=>['cuerpo.destroy_simcard',$simcard->id],'method'=>'DELETE']) !!}    {!!Form::button('<i class="fa fa-close"></i> Eliminar SIM CARD', array('class'=>'btn btn-danger btn-block', 'type'=>'submit')) !!}     
                  {!! Form::close() !!}
              </td>
            </tr>         
                          
            </tbody>            
                  </table>                  
                </div>
              </div>
            </div>  
          </div>  

@endsection