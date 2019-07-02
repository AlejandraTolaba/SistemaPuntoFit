@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="box-tittle">Listado de Actividades <a href='actividad/create'><button class="btn btn-success">Agregar</button></a></h2>
                            @include('actividad.search')
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover"> <!-- table-striped -->
                                    <thead>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </thead>
                                    @foreach ($actividades as $act)
                                        <tr>
                                            <td>{{ $act -> idactividad }}</td>
                                            <td>{{ $act -> nombre }}</td>
                                            <td>{{ $act -> estado }}</td>
                                            <td>
                                                <!-- <a href="{{URL::action('ActividadController@show',$act -> idactividad)}}"><button name="Ver" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i></button></a> -->
                                                <a href="{{URL::action('ActividadController@edit',$act -> idactividad)}}"><button name="Editar" type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                                                <a href="" data-target="#modal-delete-{{$act->idactividad}}"data-toggle="modal"><button name="Eliminar" class="btn btn-danger"><i class="fa fa-remove"></i></button></a>
                                            </td>
                                        </tr>
                                    
                                    @endforeach
                                </table>
                            </div>
                            {{$actividades->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection