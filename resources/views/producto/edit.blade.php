@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
    {!!Form::model($producto, ['route'=>['producto.update',$producto->idproducto],'method'=>'PATCH'])!!}  
	{{Form::token()}}	
        <div class="col-md-6 col-md-offset-3">
			@include('flash::message')
		</div>
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-success">
				<div class="box-header with-border">
                    <h2 class="media-heading" align="center"> Editar Producto</h2>
                </div> <!-- end-box-header -->
                <div class="box-body">
					<div class="box">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-12">
								{!! Field::number('codigo',$producto->idproducto, ['class'=>'form-control', 'disabled'=>'true'])!!}
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									{!! Field::text('nombre', ['class'=>'form-control', 'placeholder'=>'Ingrese nombre...', 'disabled'=>'true'])!!}
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
								{!! Field::number('precio', ['class'=>'form-control','step'=>'any', 'placeholder'=>'Ingrese precio...'])!!}
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
								{!! Field::number('stock', ['class'=>'form-control', 'placeholder'=>'Ingrese stock...'])!!}
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
                {!!Form::close()!!}
                </div><!-- end-box-body -->
            </div><!-- end-box-success -->
        </div><!-- end-col-md-10 -->
    </div><!-- end-div-row -->
@endsection