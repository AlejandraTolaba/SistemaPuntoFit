@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
    {!!Form::model($ficha, ['route'=>['alumno.fichaControlCorporal.update',$ficha->idficha_control],'method'=>'PATCH'])!!}  
	{{Form::token()}}	
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-success">
				<div class="box-header with-border">
                    <h2 class="media-heading" align="center"> Editar Ficha de Control Corporal</h2>
                </div> <!-- end-box-header -->
                <div class="box-body">
					<div class="row">
						<div class="col-lg-8">
							<h4 name="nombre"><b>  Nombre:</b> {{$alumno->nombre}} {{$alumno->apellido}}</h4>
						</div>
						<div class="col-lg-4">
							<h4 name="fecha"><b>  Fecha:</b> <?php echo date('d-m-Y');?></h4>
						</div>
					</div> <!-- end primer row-->
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
                            <button class="btn btn-primary" type="submit">Confirmar</button>
                            <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
                        </div>
                    </div>		
                {!!Form::close()!!}
                </div><!-- end-box-body -->
            </div><!-- end-box-success -->
        </div><!-- end-col-md-10 -->
    </div><!-- end-div-row -->
@endsection