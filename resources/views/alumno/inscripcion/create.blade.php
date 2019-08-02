@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@include('flash::message')
		</div>
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nueva Inscripción</h2>
					<script>
						$(document).ready(function(){
							$('#idactividad').change(function(){
								$.get("{{ url('dropdown')}}",
								{ option: $(this).val() },
								function(data) {
									$('#idplan').empty();
									$('#idplan').append("<option value=0 selected> - </option>");
									$.each(data, function(key, element) {
										$('#idplan').append("<option value='" + key+"'>" + element + "</option>");
									});
								});
							});
						});	
							
					</script>
					
				</div> <!-- end box-header -->
				
				
				<div class="box-body">
					{!! Form::open(array('action'=>array('InscripcionController@store',$alumno->idalumno),'method'=>'post','autocomplete'=>'off')) !!}
					{{Form::token()}}
					<div class="box">
						<div class="box-body">
							<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="nombre">Nombre del alumno</label>
												<input type="text" name="nombre" class="form-control" value="{{ $alumno->nombrecompleto}}" disabled="true">
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<label>Fecha de inscripción</label>
												<div class="input-group" disable="true">	
													<input type ="date" name="fecha_inscripcion" value="<?php echo date('Y-m-d');?>" class="form-control" disabled="true">
													<span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>
												</div>
											</div>
											
										</div>
								
							</div> <!-- end primer row-->
							
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="idactvidad">Seleccione una Actividad</label>
										<select id="idactividad" name="idactividad" class="form-control">
											<option value=0 selected> - </option>
											@foreach ($actividades as $act)
												<option value=" {{$act->idactividad}}">{{$act->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg-3">
									<div class="form-group">
										<label for="idplan">Seleccione un Plan</label>
										<select id="idplan" name="idplan" onchange='cambio_plan_mostrar_precio();' class="form-control" required>
											<option value=0 selected> - </option>
											/*  */
										</select>
									</div>
								</div>

								<div class="col-lg-3">
									<label for="precio">Precio</label>
									<div class="input-group">	
										<span class="input-group-addon" id="basic-addon2"><b>$</b></span>
										<input type="numeric" step = "any" class="form-control" id="precio" name="precio" disabled="true">  
									</div>
								</div>
							
							</div><!-- end segundo row-->
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="idforma_de_pago">Forma de pago</label>
										<select name="idforma_de_pago" class="form-control" required>
											@foreach ($formas_de_pago as $form)
												<option value=" {{$form->idforma_de_pago}}">{{$form->nombre}} </option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<label for="monto">Monto</label>
									<div class="input-group">	
										<span class="input-group-addon" id="basic-addon2"><b>$</b></span>
										<input type="number" step = "any" class="form-control" id="monto" name="monto" required>  
									</div>
								</div>
							</div><!-- end tercer row-->
						</div>
					</div>
					<div class="row" align="center">
						<div class="form-group">
							
							<button id="btn_guardar"class="btn btn-primary" type="submit">Guardar</button>
							<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
						</div>
					</div>		
						
					{!!Form::close()!!}
					

				</div> <!-- end box-body -->
			</div>
		</div> <!-- end col -->
	</div>	
	
@endsection
<script type="text/javascript">
	function cambio_plan_mostrar_precio()
	{
		datos_plan=document.getElementById('idplan').value.split('_');
		document.getElementById('precio').value = datos_plan[1];
		
		/* document.getElementById('precio').value=document.getElementById('idplan').value; */
	}

</script>