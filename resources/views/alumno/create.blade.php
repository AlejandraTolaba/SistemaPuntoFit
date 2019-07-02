@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nuevo Alumno</h2>
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
				</div> <!-- end box-header -->
				
				
				<div class="box-body">
					{!! Form::open(array('action'=>array('AlumnoController@store'),'method'=>'POST','autocomplete'=>'off')) !!}
					{{Form::token()}}
					<div class="box">
						<div class="box-header">
							<h3 class="box-title"><b>Datos personales</b></h3>
						</div>
						<div class="box-body">
							<div class="row">
								
										<div class="col-lg-5">
											<div class="form-group">
												{!! Field::text('nombre',['class'=>'form-control', 'name'=>'nombre','placeholder'=>'Nombre del alumno...', 'value'=>'old(nombre)'])!!}
											</div>
										</div>

										<div class="col-lg-5">
											<div class="form-group">
												{!! Field::text('apellido',['class'=>'form-control', 'name'=>'apellido','placeholder'=>'Apellido del alumno...', 'value'=>'old(apellido'])!!}
											</div>
										</div>
								
							</div> <!-- end primer row-->
							<div class="row">
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

								<div class="col-lg-3">
									<div class="form-group">
										<label for="sexo">Sexo</label>
										<select name="sexo" class="form-control" required>
												<option value=F>Femenino</option>
												<option value=M selected>Masculino</option>
										</select>
									</div>
								</div>
							
							</div><!-- end segundo row-->
							<div class="row">
								<div class="col-lg-10">
									<div class="form-group">
										{!! Field::text('domicilio',['class'=>'form-control', 'name'=>'domicilio','placeholder'=>'Domicilio...', 'value'=>'old(domicilio)'])!!}
									</div>
								</div>
							</div><!-- end tercer row-->
							<div class="row">
								<div class="col-lg-5">
									<div class="form-group">
										{!! Field::text('telefono_celular',['class'=>'form-control','placeholder'=>'Nro...', 'value'=>'old(telefono_celular)'])!!} 
									</div>
								</div>

								<div class="col-lg-5">
									<div class="form-group">
										<!--{!! Field::text('Número de un contacto',['class'=>'form-control', 'name'=>'numero_contacto','placeholder'=>'Nro Contacto...'])!!} -->
										<label for="numero_contacto">Contacto</label>
										<input type="text" name="numero_contacto" value="{{old('numero_contacto')}}" class="form-control" placeholder="Contacto...">
									</div>
								</div>
							</div>
							<div class="row">
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
					<div class="box">
						<div class="box-header">
							<h3 class="box-title"><b>Otros datos</b></h3>
						</div>
						<div class="box-body">
							<div class="row">
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

							</div> <!-- end 1 row segundo box -->
							<div class="row">
								<div class="col-xs-10">
									<div class="form-group">
										<label for="observaciones">Observaciones</label>
										<textarea name="observaciones" value="{{old('observaciones')}}" class="form-control" rows="5"></textarea>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="row" align="center">
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Guardar</button>
							<button class="btn btn-danger" type="reset">Cancelar</button>
						</div>
					</div>		
						
					{!!Form::close()!!}
					

				</div> <!-- end box-body -->
			</div>
		</div> <!-- end col-lg-12-->
	</div>	
	
@endsection