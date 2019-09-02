@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nuevo Producto</h2>
				</div> <!-- end box-header -->
				
				<div class="box-body">
					{!! Form::open(array('action'=>array('ProductoController@store'),'method'=>'post','autocomplete'=>'off')) !!}
					{{Form::token()}}
					<div class="box">
						<div class="box-body">
							<div class="row">
                                <div class="col-lg-12">
								    {!! Field::number('codigo', $codigo->cod, ['class'=>'form-control', 'disabled'=>'true'])!!}
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									{!! Field::text('nombre', ['class'=>'form-control','placeholder'=>'Ingrese nombre...', 'value'=>'old(nombre)'])!!}
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
								{!! Field::number('stock', ['class'=>'form-control', 'placeholder'=>'Ingrese stock...', 'value'=>'old(stock)'])!!}
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
								{!! Field::number('precio', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese  precio...', 'value'=>'old(precio)'])!!}
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
					
					<script>
                        $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
                    </script>
				</div> <!-- end box-body -->
				
			</div>
		</div> <!-- end col -->
	</div>	
	
@endsection