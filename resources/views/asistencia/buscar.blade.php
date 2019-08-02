@extends('layouts.admin')
@section('contenido')
{!! Form::open(array('url'=>'asistencia/mostrarAlumno', 'method'=>'GET', 'autocomplete'=>'off'))!!}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle">Registrar Asistencia </h2>
                    @if (session('alarma'))
                            <audio src="audios/error.mp3" autoplay></audio>
                    @endif
                </div>
                <div class="box-body">
                
                    <div class="row">
                        <div class="col-lg-12">
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