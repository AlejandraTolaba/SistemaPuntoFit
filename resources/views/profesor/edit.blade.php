@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-success">
				<div class="box-header with-border">
                    @if (($profesor->foto)!="")
                        <div class="media">
                            <div class="media-body" align="center">
                                <br>
                                <h2 class="media-heading"> Editar datos de {{$profesor->nombre}} {{$profesor->apellido}}</h2>
                            </div>
                            <div class="media-right">
                                <img class="media-object" src="{{asset('imagenes/profesores/'.$profesor->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                            </div>
                        </div>
                    @else
                        <h2 align="center" class="box-tittle">Editar datos de {{$profesor->nombre}} {{$profesor->apellido}}</h2>
                    @endif
                </div> <!-- end-box-header -->
                <div class="box-body">
                {!!Form::model($profesor, ['route'=>['profesor.update',$profesor->idprofesor],'method'=>'PATCH'])!!}  
				{{Form::token()}}	
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title"><b>Datos personales</b></h3>
							<small class="form-text text-muted"> (*) Campo obligatorio</small>
						</div>
						<div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Field::text('nombrea', $profesor->nombre)!!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('apellido')!!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Foto del profesor</label>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <video id="video" playsinline autoplay style="border:1px solid #b0b8b9;"></video>
                                                <div class="controller" > 
                                                    <input type="button" name="snap" id="snap" value="   Capturar foto   "> 
                                                </div>
                                            </div><!-- end-col-lg-4 -->
                                            <div class="col-lg-2">
                                                <canvas id="canvas" width="110" height="100" style="border:1px solid #b0b8b9;"></canvas>
                                                <input style="display:none" id='fotocamara' name="fotocamara" type="text" class="form-control">
                                            </div><!-- end-col-lg-2 -->
                                        </div> <!-- end row -->	
                                </div> <!-- end div-col-lg-6 -->
                            </div><!-- end-primer-row -->
                            <div class="row">
                                <div class="col-lg-4">
                                    {!! Field::text('dni')!!}
                                </div> <!-- end-col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento (*)</label>
                                        <div class="input-group">	
                                            <input type ="date" name="fecha_nacimiento" value={{$profesor->fecha_nacimiento}} class="form-control">
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo (*)</label>
                                        <select name="sexo" class="form-control">
                                            @if($profesor->sexo == "M")
                                                <option value="M" selected >Masculino</option>
                                                <option value="F">Femenino</option>
                                            @else
                                                <option value="M">Masculino</option>
                                                <option value="F" selected>Femenino</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end-segundo-row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! Field::text('domicilio')!!}
                                    </div>
                                </div>
                            </div><!-- end-tercer-row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Field::text('telefono_celular')!!} 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!-- {!! Field::text('contacto',['class'=>'form-control','placeholder'=>'Ingrese número de contacto'])!!} -->
                                        <label for="numero_contacto">Contacto</label>
                                        <input type="text" name="numero_contacto" value="{{$profesor->numero_contacto}}" class="form-control" placeholder="Contacto...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<label for="email">Email</label>
										<div class="input-group">
											<input type="email" name="email" value="{{$profesor->email}}" class="form-control" placeholder="email@ejemplo.com" aria-describedby="basic-addon2">
											<span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope pull-right"></i></span>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" align="center">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Confirmar</button>
                            <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
                        </div>
                    </div>
                    <script>
						'use strict';
						const video = document.getElementById('video');
						const canvas = document.getElementById('canvas');
						const snap = document.getElementById("snap");
						const errorMsgElement = document.querySelector('span#errorMsg');

						const constraints = {
							audio: false,
							video: {
								width: 120, height: 100
							}
						};

						/*Función para acceder a la webcam, vemos si el navegador tiene soporte para la webcam (no se por que me funciona solo con chrome)*/
						async function init() {
							try {
								const stream = await navigator.mediaDevices.getUserMedia(constraints);
								handleSuccess(stream); // Si no hubo problemas se vera lo que captura la webcam
							} catch (e) {
								errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
							}
						}

						function handleSuccess(stream) {
							video.srcObject = stream;
						}
						
						init();
						video.addEventListener('loadedmetadata',function(){canvas.width=video.videoWidth; canvas.height=video.videoHeight;},false);
						//si hago click en el boton "Capturar foto" aparece la imagen que capturé (esta en canvas)
						snap.addEventListener("click", function() {
							canvas.getContext('2d').drawImage(video,0,0);
							var img=canvas.toDataURL('image/png');
							//para guardar el nombre de la imagen en un input no visible, esto me servira para enviarla al controlador
							document.getElementById('fotocamara').setAttribute('value', img);
						});
					</script>		
                {!!Form::close()!!}
                </div><!-- end-box-body -->
            </div><!-- end-box-success -->
        </div><!-- end-col-md-10 -->
    </div><!-- end-div-row -->
@endsection