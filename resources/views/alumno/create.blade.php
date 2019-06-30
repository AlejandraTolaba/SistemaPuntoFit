@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Alumno</h3>	
		</div>
	</div>
	<div class="row">
		
			<div class="col-lg-4">
				<div class="flash-message">
					@foreach (['danger', 'warning', 'success', 'info','light'] as $msg)
					@if(Session::has('alert-' . $msg))
						<p class="alert alert-{{ $msg }} role="alert"">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					@endif
					@endforeach
				</div> <!-- end .flash-message -->
			</div>
		
	</div>
		
	<!-- Formulario -->
	{!! Form::open(array('action'=>array('AlumnoController@store'),'method'=>'POST','autocomplete'=>'off')) !!}
	{{Form::token()}}
			<div class="panel-group ">
				<div class="panel panel-default">
						<div class="panel-heading ">
							<h3 class="panel-title">Datos personales</h3>
						</div>
						<div class="panel-body">
							<div class="col-lg-5">
								<div class="form-group">
									<!--<label for="nombre">Nombre (*)</label>
									<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre del alumno..."> -->
									{!! Field::text('nombre',['class'=>'form-control','placeholder'=>'Nombre del alumno...', 'value'=>'old(nombre)'])!!}
									
								</div>
							</div>

							<div class="col-lg-5">
								<div class="form-group">
									<!--<label for="apellido">Apellido (*)</label>
									<input type="text" name="apellido" required value="{{old('apellido')}}" class="form-control" placeholder="Apellido del alumno...">	-->
									{!! Field::text('apellido',['class'=>'form-control', 'name'=>'apellido','placeholder'=>'Apellido del alumno...', 'value'=>'old(apellido'])!!}
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group">
									{!! Field::text('dni',['class'=>'form-control', 'name'=>'dni','placeholder'=>'Dni del alumno...', 'value'=>'old(dni)'])!!}
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group">

									<label>Fecha de nacimiento</label>
									
									<div class="input-group">
										
										<input type ="date" name="fecha_nacimiento" value="<?php echo date('Y-m-d');?>" class="form-control">
										<span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>
										
									</div>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
								
									<label for="sexo">Sexo</label>
									<select name="sexo" class="form-control" required>
											<option value=F>F</option>
											<option value=M selected>M</option>
									</select>
									
								</div>
							</div>
							<div class="row">
							</div>

							<div class="col-lg-10">
								<div class="form-group">
									{!! Field::text('domicilio',['class'=>'form-control', 'name'=>'domicilio','placeholder'=>'Domicilio...', 'value'=>'old(domicilio)'])!!}
								</div>
							</div>

							<div class="col-lg-5">
								<div class="form-group">
									{!! Field::text('telefono_celular',['class'=>'form-control','placeholder'=>'Nro...', 'value'=>'old(telefono_celular)'])!!} -
									<!--<label for="telefono_celular">Teléfono o Celular</label>
									<input type="text" name="telefono_celular" value="{{old('telefono_celular')}}" class="form-control" placeholder="Nro..."> -->
								</div>
							</div>

							<div class="col-lg-5">
								<div class="form-group">
									<!--{!! Field::text('Número de un contacto',['class'=>'form-control', 'name'=>'numero_contacto','placeholder'=>'Nro Contacto...'])!!} -->
									<label for="numero_contacto">Número de un contacto</label>
									<input type="text" name="numero_contacto" value="{{old('numero_contacto')}}" class="form-control" placeholder="Contacto...">
								</div>
							</div>

							<div class="col-lg-10">
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

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Otros datos </h3>
					</div>
					<div class="panel-body">
					
						<div class="col-xs-5">
							<div class="form-group">
								<label for="certificado">¿Presentó certificado?</label>
								<select name="certificado" class="form-control" required>
										<option value=1>SI</option>
										<option value=0 selected>NO</option>
								</select>
							</div>
						</div>

						<div class="col-xs-5">
							<div class="form-group">
								<label>Fecha de presentación</label>								
								<div class="input-group">
										<input type ="date" name="fecha_certificado" value="<?php echo date('Y-m-d');?>" class="form-control">
										<span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>		
								</div>
							</div>
						</div>
						<div class="col-xs-10">
							<div class="form-group">
								<label for="observaciones">Observaciones</label>
								<textarea name="observaciones" value="{{old('observaciones')}}" class="form-control" rows="5"></textarea>
							</div>
						</div>
						
					
					</div>
				</div>
			
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
					</div>
				</div>
			</div>	
		
	{!!Form::close()!!}
	
	
@endsection