@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nueva Ficha de Control Corporal</h2>
				</div> <!-- end box-header -->
				
				<div class="box-body">
					<div class="row">
						<div class="col-lg-8">
							<h4 name="nombre"><b>  Nombre:</b> {{ $alumno->nombre}} {{$alumno->apellido}}</h4>
						</div>
						<div class="col-lg-4">
							<h4 name="fecha"><b>  Fecha:</b> <?php echo date('d-m-Y');?></h4>
						</div>
					</div> <!-- end primer row-->
					{!! Form::open(array('action'=>array('FichaControlController@store',$alumno->idalumno),'method'=>'post','autocomplete'=>'off')) !!}
					{{Form::token()}}
					<div class="box">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-4">
									{!! Field::number('peso', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese peso...', 'value'=>'old(peso)'])!!}
								</div>

								<div class="col-lg-4">
								{!! Field::number('imc', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese IMC...', 'value'=>'old(imc)'])!!}
								</div>

								<div class="col-lg-4">
								{!! Field::number('edad_corporal', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese edad corporal...', 'value'=>'old(edad_corporal)'])!!}
								</div>
							
							</div><!-- end segundo row-->
							<div class="row">
								<div class="col-lg-4">
								{!! Field::number('grasa_corporal', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese grasa corporal...', 'value'=>'old(grasa_corporal)'])!!}
								</div>
								<div class="col-lg-4">
								{!! Field::number('imm', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese  imm...', 'value'=>'old(imm)'])!!}
								</div>
								<div class="col-lg-4">
								{!! Field::number('mb', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese  mb...', 'value'=>'old(mb)'])!!}
								</div>
							</div><!-- end tercer row-->
							<div class="row">
								<div class="col-lg-4 col-md-offset-4">
								{!! Field::number('grasa_viceral', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese grasa viceral...', 'value'=>'old(grasa_viceral)'])!!}
								</div>
								
							</div><!-- end cuarto row-->
						</div>

					</div>
					<div class="row" align="center">
						<div class="form-group">
							
							<button id="btn_guardar"class="btn btn-primary" type="submit">Guardar</button>
							<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
						</div>
					</div>		
						
					{!!Form::close()!!}
					
					<script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
				</div> <!-- end box-body -->
				
			</div>
		</div> <!-- end col -->
	</div>	
	
@endsection