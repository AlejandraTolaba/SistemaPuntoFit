@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('flash::message')
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header with-border">
                    @if($desde == $hasta)
                        <h2 name="titulo" class="box-tittle">Movimientos del {{date("d-m-Y",strtotime($desde))}}</h2>
                    @else
                        <h2 name="titulo" class="box-tittle">Movimientos desde {{date("d-m-Y",strtotime($desde))}} hasta {{date("d-m-Y",strtotime($hasta))}}</h2>
                    @endif
                    <div class="row">
                        <div class="col-lg-12" align="right">
                            <a href="{{route('movimientoReporte',[$desde,$hasta])}}"><button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Generar PDF</button></a>
                            <a href='movimiento/create'><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                        </div>
                    </div>
                    {!! Form::open(array('action'=>array('MovimientoController@mostrarMovimientosDesdeHasta'), 'method'=>'POST', 'autocomplete'=>'off'))!!}
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
                    {{Form::close()}} 
                </div>
                <div class="box-body">
                    @if($movimientos->total()!=0)
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span style="background-color: #F2F4F4;" class="input-group-addon" id="basic-addon2">TOTAL INGRESOS</span>	
                                    <input style="background-color: white;" readonly type ="text" name="totalIngreso" value="${{$totalIngreso->totalIngreso}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">	
                                    <span style=" background-color: #F2F4F4" class="input-group-addon" id="basic-addon2">TOTAL EGRESOS</span>
                                    <input style="background-color: white;" readonly type ="text" name="totalEgreso" value="${{$totalEgreso->totalEgreso}}" class="form-control">	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">	
                                    <span style=" background-color: #F2F4F4" class="input-group-addon" id="basic-addon2">TOTAL CAJA</span>
                                    <input style="background-color: white;" readonly type ="text" name="total" value="${{$total}}" class="form-control">	
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover text-center"> <!-- table-striped -->
                                <thead>
                                    <th>Concepto</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Tipo</th>
                                    <th>Forma de pago</th>
                                    <th>Monto</th>
                                </thead>
                                @foreach ($movimientos as $mov)
                                    <tr>
                                        <td>{{ $mov -> concepto }}</td>
                                        <td><?php $fecha = new DateTime($mov->fecha); echo $fecha->format('d-m-Y');?></td>
                                        <td><?php $hora = new DateTime($mov->hora); echo $hora->format('H:i');?></td>
                                        <td>{{ $mov -> tipo }}</td>
                                        <td>{{ $mov -> forma }}</td>
                                        <td>${{ $mov -> monto }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div align="center">
                            {{$movimientos->render()}}
                        </div>
                    @else
                    <div class="row" align="center">
                        <br>
                        <h4>No hay movimientos</h4>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
                                <a class="btn btn-info" href="{{ URL::previous() }}" name="Volver">Volver</a>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div> <!-- end box-body-->
            </div> <!-- end box box-success-->
        </div> <!-- end col-md-6 col-md-offset-2-->
    </div> <!-- end row-->

@endsection