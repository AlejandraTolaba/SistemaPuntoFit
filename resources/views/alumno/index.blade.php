@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Listado de Alumnos</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
								<a href='alumno/create'><button class="btn btn-success"><i class="fa fa-user-plus"></i> Agregar</button></a>
                            </div>
                            @include('alumno.search')
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th>Nombre</th>
                                        <th>DNI</th>
										<th>Teléfono</th>
                                        <th>Saldo</th> <!-- Agregue esto  -->
                                        <th style="width:40%;">Opciones</th>
                                    </thead>
                                    @foreach ($alumnos as $a)
                                        <tr>
                                            <td>{{ $a -> alumno }}</td>
                                            <td>{{ $a -> dni }}</td>
											<td>{{ $a -> telefono_celular }}</td>
                                            
                                            @if($a->saldo>0)
                                            <td class = "danger text-danger">{{'$'.$a->saldo}}</td>
                                            @else 
                                                <td>{{'$'.$a -> saldo }}</td>
                                            @endif <!-- Agregue esto  -->
                                            <td>
                                            <a href="#"><button name="Visualizar" type="submit" class="btn btn-success"><i class="fa fa-user"></i> Visualizar</button></a>
                                            <a href="{{URL::action('AlumnoController@edit',$a->idalumno)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</button></a>
                                            <a href="{{URL::action('InscripcionController@index',$a->idalumno)}}"><button name="Ver" type="submit" class="btn btn-info"><i class="fa fa-eye"></i> Inscripciones</button></a>
                                            <a href="{{URL::action('FichaControlController@index',$a -> idalumno)}}"><button name="VerFicha" type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Fichas</button></a>
                                                <!-- <a href="{{URL::action('AlumnoController@edit',$a -> idalumno)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                                                <a href="" data-target="#modal-delete-{{$a->idalumno}}"data-toggle="modal"><button name="Eliminar" class="btn btn-danger"><i class="fa fa-remove"></i></button></a> -->
                                            </td>
                                        </tr>
                                    
                                    @endforeach
                                </table>
                            </div>
							
                           <!-- aqui --> 
                        </div>
                    </div>
					<div align="center">
						{{$alumnos->render()}}
					</div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
    
@endsection