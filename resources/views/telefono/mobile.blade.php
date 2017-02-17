@extends('template.app')
@section('page', $page_title)
@section('padre', 'Moviles')
	@section('head')
	<!-- DATA TABLES -->
	{!! Html::style('admin-lte/plugins/datatables/dataTables.bootstrap.css') !!} 

	@endsection
@section('content')
<!-- Main content -->
		
        <section class="content">
          <div class="row">
          <div class="col-xs-10 col-md-8 col-md-offset-2"> 
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Moviles <small>Total: </small></h3>
                  <div class="btn-group pull-right" role="group" aria-label="...">                 
                     <button type="button" class="btn btn-default" onclick="filtro()">&laquo;</button>  
                        <button type="button" class="btn btn-default" onclick="filtro()"></button>
                        <button type="button" class="btn btn-default" onclick="filtro()">&raquo;</button></div>
                  <div class="col-md-12">
                    <form action="">
                      <div class="row">  
                      <div class="col-lg-7 col-md-push-5">
                        <div class="row">
                          <br>
                          <div class="input-group">                            
                            <input id="brandSearchInput" onkeyup="brandSearch();" type="text" class="form-control" placeholder="Buscar Marcas...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                          </div>                       
                        </div> 
                        <br>                       
                      </div><!-- /.col-lg-6 -->
                      </div><!-- /.row -->
                    </form>                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="ajax">    

                  <table class="table table-bordered table-hover">
                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-center" style="width: 5%"></th>
                      <th class="text-center" style="width: 10%"></th>
                      <th class="text-center" style="width: 20%"></th>
                      <th class="text-center" style="width: 20%"></th>
                      <th class="text-center" style="width: 20%"></th>
                      <th class="text-center" style="width: 10%"></th>
                      <th class="text-center" style="width: 10%"></th>
                    </tr>
                  </table>
                </div>

            @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('message')}}
            </div>        
    		@endif

              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@endsection
@section('footer')
	<!-- DATA TABES SCRIPT -->
	{!! Html::script('admin-lte/plugins/datatables/jquery.dataTables.min.js') !!} 
	{!! Html::script('admin-lte/plugins/datatables/dataTables.bootstrap.min.js') !!}
	<!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        
      });
    </script>
@endsection