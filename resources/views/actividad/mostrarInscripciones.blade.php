@extends('layouts.admin')
@section('contenido')
{!! Form::open(array('action'=>array('ActividadController@mostrarInscripcionesPorActividadDesdeHasta',$actividad->idactividad), 'method'=>'POST', 'autocomplete'=>'off'))!!}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 name="titulo" class="box-tittle">Inscripciones de {{$actividad->nombre}}</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-4">
                                <div class="input-group">
                                    <span style="background-color: #F2F4F4;" class="input-group-addon" id="basic-addon2">DESDE </span>	
                                    <input type ="date" name="desde" value="{{$desde}}" class="form-control">
                                </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-group">	
                                <span style=" background-color: #F2F4F4" class="input-group-addon" id="basic-addon2"> HASTA </span>
                                <input type ="date" name="hasta" value="{{$hasta}}" class="form-control">	
                            </div>
                        </div>
                        
                        <div class="col-lg-1">
                            <button class="btn btn-primary" name="filtrar"><i class="fa fa-calendar"></i></button>
                        </div>
                    </div> <!-- end row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
                                <a class="btn btn-info" href="{{ URL::previous() }}" name="Volver">Volver</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover text-center"> <!-- table-striped -->
                            <thead>
                                <th style="vertical-align:middle;">Nº</th>
                                <th style="vertical-align:middle;">Alumno</th>
                                <th style="vertical-align:middle;">Plan</th>
                                <th id="Fecha">Fecha de <br>Inscripción</th>
                                <th style="vertical-align:middle;">Estado</th>
                            </thead>
                            @foreach ($inscripciones as $ins)
                                <tr>
                                    <td>{{ $ins -> idinscripcion }}</td>
                                    <td>{{ $ins -> alumno }}</td>
                                    <td>{{ $ins -> plan }}</td>
                                    <td><?php $fecha = new DateTime($ins->fecha_inscripcion); echo $fecha->format('d-m-Y');?></td>
                                    <td>{{ $ins -> estado }}</td>
                                </tr>
                                
                            @endforeach
                        </table>
                    </div>
                </div> <!-- end box-body-->
            </div> <!-- end box box-success-->
        </div> <!-- end col-md-6 col-md-offset-2-->
    </div> <!-- end row-->
    {{Form::close()}}
@endsection