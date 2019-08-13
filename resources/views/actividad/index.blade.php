@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			@include('flash::message')
		</div>
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Listado de Actividades </h2>
                </div>             
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
                                <a href='actividad/create'><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                            </div>
                            @include('actividad.search')
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center"> <!-- table-striped -->
                                    <thead> <!-- style="background-color:#088A29" -->
                                        <th style="vertical-align:middle;">Nº</th>
                                        <th style="vertical-align:middle;">Nombre</th>
                                        <th style="vertical-align:middle;">Estado</th>
                                        <th>Inscripciones<br>
                                        Activas</th>
                                        <th style="vertical-align:middle;">Opciones</th>
                                    </thead>
                                    @foreach ($actividades as $act)
                                        <tr>
                                            <td>{{ $act -> idactividad }}</td>
                                            <td>{{ $act -> nombre }}</td>
                                            <td>{{ $act -> estado }}</td>
                                            <td>{{ $act -> cantidad_i_activas }}</td>
                                            <td>
                                                <a href="{{URL::action('ActividadController@edit',$act -> idactividad)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</button></a>
                                                <a href="{{URL::action('ActividadController@mostrarInscripcionesPorActividad',$act -> idactividad)}}"><button name="MostrarInscripciones" type="submit" class="btn btn-info"><i class="fa fa-eye"></i> Inscripciones</button></a>
                                                <!-- <a href="" data-target="#modal-delete-{{$act->idactividad}}"data-toggle="modal"><button name="Eliminar" class="btn btn-danger"><i class="fa fa-remove"></i></button></a> -->
                                            </td>
                                        </tr>
                                    
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                    <div align="center">
                        {{$actividades->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection