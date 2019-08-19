@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('flash::message')
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header">
                    <!-- <div class="row" align="center">
                        <div class="col-lg-4">
                            <a href="{{ route('alumno.create') }}"><button class="btn btn-success"><i class="fa fa-user-plus"></i><br> Agregar Alumno</button></a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('alumno.create') }}"><button class="btn btn-success"><i class="fa fa-usd"></i><br> Registrar Movimiento</button></a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ route('alumno.index') }}"><button class="btn btn-success"><i class="fa fa-list"></i><br> Listar Asistencia</button></a>
                        </div>
                    </div>
                    <br> -->

                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                        <a href="{{ route('alumno.create') }}"><button class="btn bg-olive"><i class="fa fa-user-plus"></i> Agregar Alumno</button></a>
                        </div>
                        <div class="btn-group" role="group">
                        <a href="{{ route('alumno.create') }}"><button class="btn bg-purple"><i class="fa fa-usd"></i> Agregar Movimiento</button></a>
                        </div>
                        <div class="btn-group" role="group">
                        <a href="asistencia/mostrarAsistencias"><button class="btn btn-primary"><i class="fa fa-list"></i> Listar Asistencia</button></a>
                        </div>
                    </div>
    
                </div>
                <div class="box-body">
                    <br><br><br><br><br>
                    @if (session('alarma'))
                            <audio src="audios/error.mp3" autoplay></audio>
                    @endif
                {!! Form::open(array('url'=>'asistencia/mostrarAlumno', 'method'=>'GET', 'autocomplete'=>'off'))!!}
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder="Ingrese DNI..." autofocus>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary" id="btn"><i class="fa fa-search"></i> Buscar</button>
                                    </span>  
                                </div> <!-- end input-group-->
                            </div> <!-- end form-group-->
                        </div> <!-- end col-lg-12-->
                    </div> <!-- end row-->
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div> <!-- end box-body-->
            </div> <!-- end box box-success-->
        </div> <!-- end col-md-6 col-md-offset-2-->
    </div> <!-- end row-->
    {{Form::close()}}
@endsection