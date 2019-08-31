@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('flash::message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle" align="center">Actualizar Vencimiento</h2> 
                </div>
                {!! Form::open(array('action'=>array('InscripcionController@actualizarFechaVencimiento',$inscripcion->idinscripcion),'method'=>'post')) !!}
                {{Form::token()}}
                <div class="box-body">
                        <div class="col-md-offset-1">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <h4 name="fecha"><b>Fecha de Inscripcion: </b><?php $fecha = new DateTime($inscripcion->fecha_inscripcion); echo $fecha->format('d-m-Y');?></h4>
                                    <h4 name="nombre"><b>Nombre: </b>{{$inscripcion->nombrecompleto}}</h4>
                                </div>
                                <div class="col-md-5 ">
                                    <h4 name="inscripcion"><b>N° de Inscripción: </b>{{$inscripcion->idinscripcion}}</h4>
                                    <h4 name="actividad"><b>Actividad: </b>{{$inscripcion->actividad}}</h4>             
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col" >
                                    <div class="form-group">
                                        <h4 for="fechav" class="col-sm-4"><b>Fecha de Vencimiento: </b></h4>
                                        <div class="form-group" style="width:85%">
                                            <div class="input-group">	
                                                <input type ="date" name="fecha_vencimiento_inscripcion" value="{{$inscripcion->fecha_vencimiento_inscripcion}}" class="form-control">
                                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
                </div> <!-- end box-body -->
                <div class="box-footer">
                        <div class="row" align="center">
                            <div class="form-group">
                                <button id="Confirmar" name="Confirmar" class="btn btn-primary" type="submit">Confirmar</button>
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
                            </div>
                        </div>
                </div> <!-- end box-footer -->
                {{Form::close()}}
            </div> <!-- end box-success -->
            
        </div>
    </div>
@endsection