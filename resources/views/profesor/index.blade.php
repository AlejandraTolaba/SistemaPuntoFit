@extends('layouts.admin')
@section('contenido')
    <div class="row">
    <div class="col-lg-10 col-md-offset-1">
        @include('flash::message')
    </div>
        <div class="col-lg-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Listado de Profesores</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
								<a href='profesor/create'><button class="btn btn-success"><i class="fa fa-user-plus"></i> Agregar</button></a>
                            </div>
                            @include('profesor.search')
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th style="width:15%;">Foto</th>
                                        <th>Nombre</th>
                                        
                                        <th>DNI</th>
										<th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </thead>
                                    @foreach ($profesores as $p)
                                        <tr> 
                                        <td ><img src="{{asset('imagenes/profesores/'.$p->foto)}}" alt="{{$p->foto}}" height="80px" width="80px" style="border:1px solid #b0b8b9;"></td>
                                            <td style="vertical-align:middle;">{{ $p -> profesor }}</td>
                                            
                                            <td style="vertical-align:middle;">{{ $p -> dni }}</td>
											<td style="vertical-align:middle;">{{ $p -> telefono_celular }}</td>
                                            <td style="vertical-align:middle;">{{ $p -> estado }}</td>
                                            <td style="vertical-align:middle;">
                                                <a href="{{URL::action('ProfesorController@show',$p->idprofesor)}}" ><button name="Visualizar" type="submit" class="btn btn-success"><i class="fa fa-user"></i> Visualizar</button></a>
                                                <a href="{{URL::action('ProfesorController@edit',$p->idprofesor)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
					<div align="center">
						{{$profesores->render()}}
					</div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
    
@endsection