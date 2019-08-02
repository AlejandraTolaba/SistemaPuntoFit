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
                    <h2 class="box-tittle" align="center">Actualizar Saldo</h2> 
                </div>
                {!! Form::open(array('action'=>array('InscripcionController@actualizarSaldo',$inscripcion->idinscripcion),'method'=>'post')) !!}
                {{Form::token()}}
                <div class="box-body">
                        <div class="col-md-offset-1">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <h4 name="nombre"><b>Nombre:  {{$inscripcion->nombrecompleto}}</b></h4>
                                    <h4 name="inscripcion"><b>N° de Inscripción: </b>{{$inscripcion->idinscripcion}}</h4>
                                    <h4 name="actividad"><b>Actividad: </b>{{$inscripcion->actividad}}</h4>
                                    <h4 name="plan"><b>Plan: </b>{{$inscripcion->plan}}</h4>                        
                                </div>
                                <div class="col-md-5 ">
                                    
                                    <h4 name="fecha"><b>Fecha: <?php $fecha = new DateTime($inscripcion->fecha_inscripcion); echo $fecha->format('d-m-Y');?></b></h4>
                                    <h4 name="formadepago"><b>Forma de pago: </b>{{$inscripcion->forma}}</h4>
                                    <h4 name="monto"><b>Monto pagado: </b>${{$inscripcion->monto}}</h4>
                                    <h4 name="saldo" style="color:#CB4335;"><b>Saldo: </b>${{$inscripcion->saldo}}</h4>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col" >
                                    <div class="form-group">
                                    <h4 for="monto_movimiento" class="col-sm-3"><b>Monto a pagar:</b></h4>
                                    <div class="input-group">	
                                        <span class="input-group-addon" id="basic-addon2"><b>$</b></span>
                                        <input type:"number" style="width:80%;" step ="any" class="form-control" id="monto_movimiento" name="monto_movimiento" autocomplete="off" required> 
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