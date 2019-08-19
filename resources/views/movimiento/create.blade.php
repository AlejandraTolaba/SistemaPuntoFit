@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@include('flash::message')
		</div>
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nuevo Movimiento</h2>			
				</div> <!-- end box-header -->
				<div class="box-body">
					{!! Form::open(array('action'=>array('MovimientoController@store'),'method'=>'POST','autocomplete'=>'off')) !!}
					{{Form::token()}}
					<div class="box">
						<div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <div class="input-group">	
                                            <input type ="date" name="fecha" value="<?php echo date('Y-m-d');?>" class="form-control">
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar pull-right"></i></span>
                                        </div>
                                    </div>
                                </div>
								<div class="col-lg-6">
									<div class="form-group">
										{!! Field::select('tipo', ['INGRESO'=>'INGRESO','EGRESO'=>'EGRESO'], ['empty'=>'-'])!!}
									</div>	
								</div>
                            </div>
							<div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										{!! Field::text('concepto',['class'=>'form-control','placeholder'=>'Ingrese concepto...', 'value'=>'old(concepto)'])!!}
                                    </div>
                                </div>
                            </div> 
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
									{!! Field::select('idforma_de_pago', ['1'=>'Contado','2'=>'Tarjeta de crédito','3'=>'Tarjeta de débito','4'=>'Débito automático'], ['empty'=>'-'])!!}
									</div>
								</div>
                                
								<div class="col-lg-6">
									<!-- <label for="monto">Monto</label> 
									<div class="input-group">	
										<span class="input-group-addon" id="basic-addon2"><b>$</b></span>
										 <input type="number" step = "any" class="form-control" name="monto" value="{{old('monto')}}" required> 
									</div> -->
									{!!Field::number('monto',null, ['class'=>'form-control','step'=>'any','value'=>'old(monto)'])!!}
								</div>
							</div>
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
	</div>	
@endsection
