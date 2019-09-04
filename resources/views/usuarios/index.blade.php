@extends('layouts.admin')
@section('contenido')
    <div class="row">
    <div class="col-lg-10 col-md-offset-1">
        @include('flash::message')
    </div>
        <div class="col-lg-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Listado de Usuarios</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
								<a href='usuarios/create'><button class="btn btn-success"><i class="fa fa-user-plus"></i> Agregar</button></a>
                            </div>
                            @include('usuarios.search')
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th>Nombre</th>
                                        <th>E-Mail</th>
                                        <th>Tipo</th>
                                        <th>Opción</th>
                                    </thead>
                                    @foreach ($usuarios as $u)
                                        <tr>
                                            <td >{{ $u->name }}</td>
                                            <td >{{ $u->email }}</td>
                                            <td >{{ $u->tipo}}</td>
                                            <td>
                                                <a href="" id="Eliminar-{{$u->id}}" data-target="#modal-delete-{{$u->id}}" data-toggle="modal"><button class="btn btn-danger" name="Eliminar-{{$u->id}}""><i class="fa fa-remove"></i> Eliminar</button></a>
                                            </td>
                                        </tr>
                                        @include('usuarios.destroy')
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
					<div align="center">
						{{$usuarios->render()}}
					</div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
    
@endsection