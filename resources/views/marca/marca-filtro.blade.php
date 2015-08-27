<table class="table table-bordered">
                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-center" style="width: 30%">Marca</th>
                      <th class="text-center" style="width: 30%">Progress</th>
                      <th class="text-center" style="width: 35%">Label</th>
                    </tr>
                    
                    @foreach($marcas as $marca)                      
                    <tr class="text-center">                   
                    
                    <td>{{ $k++ }}</td>
                    <td>{{$marca->str_marca}}</td>                                        
                    @if ($marca->bol_eliminado == 0)
                      <td><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                      @else
                        <td><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                      @endif                                            
                      <td>
                        <div class="btn-group">
                                <a class="btn btn-warning btn-flat" href="{{route('marca.edit',$marca->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-info btn-flat" href="{{route('marca.show',$marca->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                                <a class="btn bg-purple btn-flat" href="{{route('marca.status',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>     
                                <a class="btn btn-danger btn-flat" href="{{route('marca.delete',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-close"></i></a>
                                <a class="btn btn-success btn-flat" href="{{route('marca.edit_seo',$marca->id)}}" title="SEO Tipos Asociados"><i class="fa fa-globe"></i></a>                         

                          </div>
                      </td> 
                                      
                  </tr>
                  @endforeach
                    
                  </table>