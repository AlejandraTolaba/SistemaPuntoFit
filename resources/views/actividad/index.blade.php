@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Actividades <a href='actividad/create'><button class="btn btn-success">Agregar</button></a></h3>
            @include('actividad.search')
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
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
                                <a href="{{URL::action('ActividadController@edit',$act -> idactividad)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$act->idactividad}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                    
                    @endforeach
                </table>
            </div>
            {{$actividades->render()}}
        </div>
    </div>
@endsection