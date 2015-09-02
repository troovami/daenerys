 <br>
<table class="table table-bordered col-md-12 table-hover">
                            <tr>
                              <th class="text-center" style="width: 5%">#</th>
                              <th class="text-center" style="width: 20%">Logo</th>
                              <th class="text-center" style="width: 30%">Marca</th>
                              <th class="text-center" style="width: 10%">Estatus</th>
                              <th class="text-center" style="width: 35%">Operaciones</th>
                            </tr>
                            <!-- &nbsp; -->
                            @foreach($marcas as $marca)  
                             <tr class="text-center"> 
                              <td style="padding-top:20px;">{{ $k++ }}</td>
                              @if ($marca->blb_img == null)
                              <td><img style="width:50px;" src="{{ asset('images/troovami-logo-online.png') }}" /></td>
                              @else
                              <td><img style="width:50px;" src="data:{{$marca->format}};base64,{{$marca->blb_img}}" /></td>
                              @endif
                              <td style="padding-top:20px;">{{$marca->str_marca}}</td>    
                              @if ($marca->bol_eliminado == 0)
                              <td style="padding-top:20px;"><span class="label label-success"><i class="fa fa-check"></i> ACTIVADO</span></td>
                              @else
                                <td style="padding-top:20px;"><span class="label label-default"><i class="fa fa-ban"></i> DESACTIVADO</span></td>
                              @endif                                                             
                              <td style="padding-top:15px;">
                                <div class="btn-group">
                                <a class="btn btn-warning btn-flat" href="{{route('marca.edit',$marca->id)}}" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-info btn-flat" href="{{route('marca.show',$marca->id)}}" title="Consultar"><i class="fa fa-search"></i></a>
                                <a class="btn bg-purple btn-flat" href="{{route('marca.status',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-ban"></i></a>     
                                <a class="btn btn-danger btn-flat" href="{{route('marca.delete',$marca->id)}}" title="Cambiar Status (Activar / Desactivar)"><i class="fa fa-close"></i></a>
                                <a class="btn btn-success btn-flat" href="{{route('marca.edit_seo',$marca->id)}}" title="SEO Tipos Asociados"><i class="fa fa-globe"></i></a>                        

                                </div>
                                <!-- Single button 
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i> <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a href="{{route('marca.edit',$marca->id)}}"><i class="fa fa-pencil"></i> Editar</a></li>
                                    <li><a href="{{route('marca.show',$marca->id)}}"><i class="fa fa-search"></i> Consultar</a></li>
                                    <li><a href="{{route('marca.status',$marca->id)}}"><i class="fa fa-ban"></i> Cambiar Estatus</a></li>
                                    <li><a href="{{route('marca.delete',$marca->id)}}"><i class="fa fa-close"></i> Eliminar</a></li>
                                    <li><a href="{{route('marca.edit_seo',$marca->id)}}"><i class="fa fa-globe"></i> SEO Tipos Asociados</a></li>
                                  </ul>
                                </div>
                                -->
                              </td>
                            </tr>
                            @endforeach
                            
                          </table>