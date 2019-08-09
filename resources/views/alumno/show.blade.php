@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading" name="datos"><b> DATOS DEL ALUMNO</b></div>
                                    <div class="panel-body">
                                        @if($alumno->foto != '')
                                            <div class="col-lg-6">
                                                <h5 name="nombre"><b>Nombre:</b> {{$alumno->nombre}} {{$alumno->apellido}}</h5>
                                                <h5 name="dni"><b>DNI:</b> {{$alumno->dni}}</h3>
                                                <h5 name="fecha_nacimiento"><b>Fecha de Nacimiento:</b> <?php $fv = new DateTime($alumno->fecha_nacimiento); echo $fv->format('d-m-Y');?></h5>
                                                @if ($alumno->sexo == "F")
                                                    <h5 name="sexo"><b>Sexo:</b> Femenino</h5>
                                                @else
                                                    <h5 name="sexo"><b>Sexo:</b> Masculino</h5>
                                                @endif
                                                <h5 name="domicilio"><b>Domicilio:</b> {{$alumno->domicilio}}</h5>
                                                <h5><b>Teléfono:</b> {{$alumno->telefono_celular}}</h5>
                                                @if ($alumno->numero_contacto != '')
                                                    <h5 name="contacto"><b>Contacto:</b> {{$alumno->numero_contacto}}</h5>
                                                @endif
                                                @if ($alumno->email != ' ')
                                                    <h5 name="email"><b>Email:</b> {{$alumno->email}}</h5>
                                                @endif
                                                @if ($alumno->certificado)
                                                    <h5 name="certificado"><b>Certificado:</b> SI</h5>
                                                @else
                                                    <h5 name="certificado"><b>Certificado:</b> NO</h5>
                                                @endif
                                                @if ($alumno->certificado)
                                                    <h5 name="fecha_presentacion"><b>Fecha de Presentación:</b> <?php $fv = new DateTime($alumno->fecha_certificado); echo $fv->format('d-m-Y');?></h3>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <br>
                                                <div align="center">
                                                    <img src="{{asset('imagenes/alumnos/'.$alumno->foto)}}" alt="{{$alumno->foto}}" height="180px" width="180px" style="border:1px solid #b0b8b9;"></h5>
                                                </div>
                                            </div>
                                            @else
                                                <div class="col-lg-5">
                                                    <h5 name="nombre"><b>Nombre:</b> {{$alumno->nombre}} {{$alumno->apellido}}</h5>
                                                    <h5 name="dni"><b>DNI:</b> {{$alumno->dni}}</b></h3>
                                                    <h5 name="fecha_nacimiento"><b>Fecha de Nacimiento:</b> <?php $fv = new DateTime($alumno->fecha_nacimiento); echo $fv->format('d-m-Y');?></h5>
                                                    @if ($alumno->sexo == "F")
                                                        <h5 name="sexo"><b>Sexo:</b> Femenino</h5>
                                                    @else
                                                        <h5 name="sexo"><b>Sexo:</b> Masculino</h5>
                                                    @endif
                                                    @if ($alumno->certificado)
                                                        <h5 name="certificado"><b>Certificado:</b> SI</h5>
                                                        <h5 name="fecha_presentacion"><b>Fecha de Presentación:</b> <?php $fv = new DateTime($alumno->fecha_certificado); echo $fv->format('d-m-Y');?></h3>
                                                    @else
                                                        <h5 name="certificado"><b>Certificado:</b> NO</h5>
                                            @endif
                                                </div>
                                                <div class="col-lg-7">
                                                    <h5 name="domicilio"><b>Domicilio:</b> {{$alumno->domicilio}}</h5>
                                                    <h5 name="telefono"><b>Teléfono:</b> {{$alumno->telefono_celular}}</h5>
                                                    @if ($alumno->numero_contacto != '')
                                                        <h5 name="contacto"><b>Contacto:</b> {{$alumno->numero_contacto}}</h5>
                                                    @endif
                                                    @if ($alumno->email != '')
                                                        <h5 name="email"><b>Email:</b> {{$alumno->email}}</h5>
                                                    @endif
                                                </div>
                                                
                                            @endif
                                    </div>
                        </div>
                        
                    </div> <!-- end primer col-lg-->
                </div>
                @if ($alumno->observaciones != '')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success" name="pobservaciones">
                            <div class="panel-heading"><b>OBSERVACIONES</b></div>
                                <div class="panel-body">
                        
                                        <div class="col-lg-12">
                                            <h5 name="observaciones">{{$alumno->observaciones}}</h5>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
                    
                @endif
                @if($alumno->rutina != '')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading"><b>RUTINA</b></div>
                                <div class="panel-body" name="prutina">
                                    
                                        <div class="col-lg-12">
                                                <h5 name="rutina">{{$alumno->rutina}}</h5>
                                        </div> 
                                </div>  
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div align="right">
                            <a class="btn btn-info" href="{{ URL::previous() }}">Volver</a>
                        </div>
                    </div>
                </div>
            </div> <!-- end-box-body1 -->
            
        </div>
    </div> <!-- end col-lg-12-->
</div>	
	
@endsection