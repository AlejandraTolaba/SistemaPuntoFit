@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			@include('flash::message')
		</div>
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Listado de Productos</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
								<a href='producto/create'><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                            </div>
                            @include('producto.search')
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th>Código</th>
                                        <th>Nombre</th>
										<th>Precio</th>
                                        <th>Stock</th> 
                                        <th>Opciones</th>
                                    </thead>
                                    @foreach ($productos as $p)
                                        <tr>
                                            <td>{{$p->idproducto}}</td>
                                            <td>{{ $p -> nombre }}</td>
											<td>{{ '$'.$p -> precio }}</td>
                                            @if($p->stock == 0)
                                                <td class = "danger text-danger">{{$p->stock}}</td>
                                            @elseif ($p->stock < 10)
                                                <td class = "info text-info">{{$p->stock}}</td>
                                            @else
                                                <td>{{$p->stock}}</td>
                                            @endif
                                            <td>
                                                <a href="{{URL::action('ProductoController@edit',$p -> idproducto)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</button></a>
                                                <a href="" data-target="#modal-delete-{{$p->idproducto}}" data-toggle="modal"><button class="btn btn-danger" name="Eliminar"><i class="fa fa-remove"></i> Eliminar</button></a>
                                            </td>    
                                        </tr>
                                        @include('producto.destroy')
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
					<div align="center">
						{{$productos->render()}}
					</div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
    
@endsection