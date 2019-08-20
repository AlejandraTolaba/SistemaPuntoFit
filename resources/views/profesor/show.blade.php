@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading" name="datos"><b> DATOS PERSONALES</b></div>
                                    <div class="panel-body">
                                        @if($profesor->foto != '')
                                            <div class="col-lg-6">
                                                <h5 name="nombre"><b>Nombre:</b> {{$profesor->nombre}} {{$profesor->apellido}}</h5>
                                                <h5 name="dni"><b>DNI:</b> {{$profesor->dni}}</h3>
                                                <h5 name="fecha_nacimiento"><b>Fecha de Nacimiento:</b> <?php $fv = new DateTime($profesor->fecha_nacimiento); echo $fv->format('d-m-Y');?></h5>
                                                @if ($profesor->sexo == "F")
                                                    <h5 name="sexo"><b>Sexo:</b> Femenino</h5>
                                                @else
                                                    <h5 name="sexo"><b>Sexo:</b> Masculino</h5>
                                                @endif
                                                <h5 name="domicilio"><b>Domicilio:</b> {{$profesor->domicilio}}</h5>
                                                <h5><b>Teléfono:</b> {{$profesor->telefono_celular}}</h5>
                                                @if ($profesor->numero_contacto != '')
                                                    <h5 name="contacto"><b>Contacto:</b> {{$profesor->numero_contacto}}</h5>
                                                @endif
                                                @if ($profesor->email != ' ')
                                                    <h5 name="email"><b>Email:</b> {{$profesor->email}}</h5>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <br>
                                                <div align="center">
                                                    <img src="{{asset('imagenes/profesores/'.$profesor->foto)}}" alt="{{$profesor->foto}}" height="180px" width="180px" style="border:1px solid #b0b8b9;"></h5>
                                                </div>
                                            </div>
                                            @else
                                                <div class="col-lg-5">
                                                    <h5 name="nombre"><b>Nombre:</b> {{$profesor->nombre}} {{$profesor->apellido}}</h5>
                                                    <h5 name="dni"><b>DNI:</b> {{$profesor->dni}}</b></h3>
                                                    <h5 name="fecha_nacimiento"><b>Fecha de Nacimiento:</b> <?php $fv = new DateTime($profesor->fecha_nacimiento); echo $fv->format('d-m-Y');?></h5>
                                                    @if ($profesor->sexo == "F")
                                                        <h5 name="sexo"><b>Sexo:</b> Femenino</h5>
                                                    @else
                                                        <h5 name="sexo"><b>Sexo:</b> Masculino</h5>
                                                    @endif
                                                </div>
                                                <div class="col-lg-7">
                                                    <h5 name="domicilio"><b>Domicilio:</b> {{$profesor->domicilio}}</h5>
                                                    <h5 name="telefono"><b>Teléfono:</b> {{$profesor->telefono_celular}}</h5>
                                                    @if ($profesor->numero_contacto != '')
                                                        <h5 name="contacto"><b>Contacto:</b> {{$profesor->numero_contacto}}</h5>
                                                    @endif
                                                    @if ($profesor->email != '')
                                                        <h5 name="email"><b>Email:</b> {{$profesor->email}}</h5>
                                                    @endif
                                                </div>
                                            @endif
                                    </div>
                        </div>
                        
                    </div> <!-- end primer col-lg-->
                </div>
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