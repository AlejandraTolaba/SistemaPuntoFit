@extends('layouts.admin')
@section('contenido')
    <div class="col">
        @include('flash::message')
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Inscripciones de {{$alumno->nombrecompleto}}</h2> 
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
								<a href="{{URL::action('InscripcionController@create',$alumno->idalumno)}}"><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                            </div>
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th>Actividad</th>
                                        <th>Plan</th>
										<th>Fecha de Vencimiento</th>
                                        <th>Clases restantes</th> 
                                        <th>Saldo</th>
                                        <th>Estado</th>
                                        <th>Actualizar</th>
                                    </thead>
                                    @foreach ($inscripciones as $insc)
                                        <tr>
                                            <td>{{ $insc -> actividad }}</td>
                                            <td>{{ $insc -> plan }}</td>
											<td><?php $fv = new DateTime($insc->fecha_vencimiento_inscripcion); echo $fv->format('d-m-Y');?></td>
                                            <td>{{ $insc -> cantidad }}</td>
                                            @if($insc->saldo>0)
                                            <td class = "danger text-danger">{{'$'.$insc->saldo}}</td>
                                            @else 
                                                <td>{{ '$'.$insc -> saldo }}</td>
                                            @endif <!-- Agregue esto  -->
                                            <td>{{ $insc -> estado }}</td>
                                            <td>
                                            @if($insc->saldo>0)
                                                <a href="{{URL::action('InscripcionController@mostrarInscripcion',$insc->idinscripcion)}}"><button name="Actualizar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Saldo</button></a>
                                            @else
                                                <button name="Actualizar" class="btn btn-warning" disabled><i class="fa fa-pencil"></i> Saldo</button>
                                            @endif
                                            @if($insc->estado=="Activa")
                                                <a href="{{URL::action('InscripcionController@mostrarFechasInscripcion',$insc->idinscripcion)}}"><button name="ActualizarFechaV" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Fecha Vencimiento</button></a>
                                            @else
                                                <button name="ActualizarFechaV" class="btn btn-primary" disabled><i class="fa fa-pencil"></i> Fecha Vencimiento</button>
                                            @endif
                                            <a href="" id="Eliminar-{{$insc->idinscripcion}}" data-target="#modal-delete-{{$insc->idinscripcion}}" data-toggle="modal"><button class="btn btn-danger" name="Eliminar-{{$insc->idinscripcion}}"><i class="fa fa-remove"></i> Eliminar</button></a>
                                            <!-- <a href=""><button name="Ver" type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button></a>
                                            <a href=""><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-check"></i></button></a> -->
                                        
                                            </td>
                                        </tr>
                                        @include('alumno.inscripcion.destroy')
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
					<div align="center">
						{{$inscripciones->render()}}
					</div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
                                <a class="btn btn-info" href="{{ URL::previous() }}" name="Volver">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection