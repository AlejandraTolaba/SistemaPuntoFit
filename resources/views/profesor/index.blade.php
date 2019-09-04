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
                                <table class="display table table-hover text-center" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                                    <thead>
                                        <th style="width:15%;">Foto</th>
                                        <th>Nombre</th>
                                        <th>DNI</th>
										<th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </thead>
                                    @foreach ($profesores as $p)
                                        @if ($p->estado!='Inactivo')
                                            <tr role="row" class="odd">
                                        @else
                                            <tr role="row" class="odd danger text-danger">
                                        @endif
                                        <td ><img src="{{asset('imagenes/profesores/'.$p->foto)}}" alt="{{$p->foto}}" height="80px" width="80px" style="border:1px solid #b0b8b9;"></td>
                                            <td style="vertical-align:middle;">{{ $p -> profesor }}</td>
                                            <td style="vertical-align:middle;">{{ $p -> dni }}</td>
											<td style="vertical-align:middle;">{{ $p -> telefono_celular }}</td>
                                            <td style="vertical-align:middle;">{{ $p -> estado }}</td>
                                            <td style="vertical-align:middle;">
                                                @if ($p->estado!='Inactivo')
                                                    <a href="{{URL::action('ProfesorController@show',$p->idprofesor)}}" ><button name="Visualizar" type="submit" class="btn btn-success"><i class="fa fa-user"></i> Visualizar</button></a>
                                                    <a href="{{URL::action('ProfesorController@edit',$p->idprofesor)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</button></a>
                                                    @if(Auth::user()->tipo =='ADMINISTRADOR')
                                                        <a href="" id="Deshabilitar-{{$p->idprofesor}}" data-target="#modal-delete-{{$p->idprofesor}}" data-toggle="modal"><button class="btn btn-danger" name="Deshabilitar-{{$p->idprofesor}}""><i class="fa fa-remove"></i> Deshabilitar</button></a>
                                                    @endif
                                                @else
                                                    <button name="Visualizar" type="submit" class="btn btn-success" disabled><i class="fa fa-user"></i> Visualizar</button></a>
                                                    <button name="Editar" type="submit" class="btn btn-warning" disabled><i class="fa fa-pencil"></i> Editar</button></a>
                                                    @if(Auth::user()->tipo =='ADMINISTRADOR')
                                                        <a href="" id="Habilitar-{{$p->idprofesor}}" data-target="#modal-habilitar-{{$p->idprofesor}}" data-toggle="modal"><button class="btn btn-success" name="Habilitar-{{$p->idprofesor}}""><i class="fa fa-check"></i> Habilitar</button></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @include('profesor.destroy')
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