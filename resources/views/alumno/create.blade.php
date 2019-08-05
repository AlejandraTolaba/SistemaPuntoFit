@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nuevo Alumno</h2>
					
				</div> <!-- end box-header -->
				
				
				<div class="box-body">
					{!! Form::open(array('url'=>'alumno','method'=>'POST','autocomplete'=>'off')) !!}
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
												{!! Field::text('nombrea',['class'=>'form-control','placeholder'=>'Nombre del alumno...', 'value'=>'old(nombrea)'])!!}
												<!-- <label for="nombre">Nombre (*)</label>
												<input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre del alumno..." required> -->
											</div>
											<div class="form-group">
												{!! Field::text('apellido',['class'=>'form-control', 'name'=>'apellido','placeholder'=>'Apellido del alumno...', 'value'=>'old(apellido)'])!!}
											</div>
										</div>
										
										<div class="col-lg-6">
											<label>Foto del alumno</label>
										
											<div class="row">
												<div class="col-lg-4">
													<!-- Video via webcam -->
													<!-- <div class="video-wrap"> -->
														<video id="video" playsinline autoplay style="border:1px solid #b0b8b9;"></video>
												<!-- 	</div> -->
													<!-- Boton para tomar foto -->
													<div class="controller" > 
														<input type="button" name="snap" id="snap" value="   Capturar foto   "> 
													</div>
													
												</div>
												<div class="col-lg-2">
														<canvas id="canvas" width="110" height="100" style="border:1px solid #b0b8b9;"></canvas>
														<input style="display:none" id='fotocamara' name="fotocamara" type="text" class="form-control">
												</div>
											</div> <!-- end row -->		
										</div> <!-- end col-lg-6-->
											
							</div> <!-- end primer row-->
							<br>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										{!! Field::number('dni',['class'=>'form-control', 'name'=>'dni','placeholder'=>'Dni del alumno...', 'value'=>'old(dni)','maxlength'=>'8'])!!}
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label>Fecha de nacimiento (*)</label>
										<div class="input-group">	
											<input type ="date" name="fecha_nacimiento" value="<?php echo date('Y-m-d');?>" class="form-control">
											<span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label for="sexo">Sexo (*)</label>
										<select name="sexo" class="form-control" required>
												<option value=F>Femenino</option>
												<option value=M selected>Masculino</option>
										</select>
									</div>
								</div>
							
							</div><!-- end segundo row-->
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										{!! Field::text('domicilio',['class'=>'form-control', 'name'=>'domicilio','placeholder'=>'Domicilio...', 'value'=>'old(domicilio)'])!!}
									</div>
								</div>
							</div><!-- end tercer row-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										{!! Field::text('telefono_celular',['class'=>'form-control','placeholder'=>'Nro...', 'value'=>'old(telefono_celular)'])!!} 
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<!--{!! Field::text('Número de un contacto',['class'=>'form-control', 'name'=>'numero_contacto','placeholder'=>'Nro Contacto...'])!!} -->
										<label for="numero_contacto">Contacto</label>
										<input type="text" name="numero_contacto" value="{{old('numero_contacto')}}" class="form-control" placeholder="Contacto...">
									</div>
								</div>
							</div><!-- end cuarto row-->
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="email">Email</label>
										<div class="input-group">
											<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="email@ejemplo.com" aria-describedby="basic-addon2">
											<span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope pull-right"></i></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box">
						<div class="box-header">
							<h3 class="box-title"><b>Otros datos</b></h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label for="certificado">¿Presentó certificado?</label>
										<select name="certificado" class="form-control" required>
												<option value=1>SI</option>
												<option value=0 selected>NO</option>
										</select>
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label>Fecha de presentación</label>								
										<div class="input-group">
												<input type ="date" name="fecha_certificado" value="<?php echo date('Y-m-d');?>" class="form-control">
												<span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>		
										</div>
									</div>
								</div>

							</div> <!-- end 1 row segundo box -->
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label for="observaciones">Observaciones</label>
										<textarea id="observaciones" name="observaciones" value="{{old('observaciones')}}" class="form-control" rows="5" maxlength="500"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<label for="observaciones">Rutina</label>
										<textarea id="rutina" name="rutina" value="{{old('rutina')}}" class="form-control" rows="7"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" align="center">
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Guardar</button>
							<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
						</div>
					</div>		
						
					{!!Form::close()!!}
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

				</div> <!-- end box-body -->
			</div>
		</div> <!-- end col-lg-12-->
	</div>	
	
@endsection