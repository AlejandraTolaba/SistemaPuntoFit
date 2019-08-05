@extends('layouts.admin')
@section('contenido')
    <div class="col">
        @include('flash::message')
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    @if (($alumno->foto)!="")
                        <div class="media">
                            <div class="media-body" align="center">
                                <br>
                                <h2 class="media-heading"> Fichas de Control Corporal de {{$alumno->nombrecompleto}}</h2>
                            </div>
                            <div class="media-right">
                                <img class="media-object" src="{{asset('imagenes/alumnos/'.$alumno->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                            </div>
                        </div>
                    @else
                        <h2 align="center" class="box-tittle">Fichas de Control Corporal de {{$alumno->nombrecompleto}}</h2>
                    @endif
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div align="right">
								<a href="{{URL::action('FichaControlController@create',$alumno->idalumno)}}"><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                            </div>
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th>Fecha</th>
                                        <th>Peso</th>
										<th>Edad Corporal</th>
                                        <th>IMC</th> 
                                        <th>Grasa Corporal</th>
                                        <th>IMM</th>
                                        <th>MB</th>
                                        <th>Grasa Visceral</th>
                                    </thead>
                                    @foreach ($fichas as $ficha)
                                        <tr>
                                            <td><?php $f = new DateTime($ficha->fecha); echo $f->format('m-Y');?></td>
                                            <td>{{ $ficha-> peso }}</td>
                                            <td>{{ $ficha -> edad_corporal }}</td>
                                            <td>{{ $ficha -> imc }}</td>
                                            <td>{{ $ficha -> grasa_corporal }}</td>
                                            <td>{{ $ficha -> imm }}</td>
                                            <td>{{ $ficha -> mb }}</td>
                                            <td>{{ $ficha -> grasa_viceral }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
					<div align="center">
						{{$fichas->render()}}
					</div>
                    <script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
                </div>
            </div>
        </div>
    </div>
    
@endsection