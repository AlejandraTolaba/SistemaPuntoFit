@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@include('flash::message')
		</div>
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-success">
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nueva Venta</h2>			
				</div> <!-- end box-header -->
				<div class="box-body">
					<meta name="_token" content="{!! csrf_token() !!}"/>
					<div class="box">
						<div class="box-body">
                            <div class="row">
                            <div class="col-lg-12">
									<div class="form-group">
										<label for="producto">Seleccione Producto</label>
										<select id="producto" name="producto" class="form-control" onchange="cambio_producto_mostrar_precio();">
                                        <option value=0 selected> - </option>
                                            @foreach ($productos as $prod)
												<option value="{{$prod->idproducto}}_{{$prod->precio}}_{{$prod->stock}}">{{$prod->idproducto}} - {{$prod->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
									<label for="precio">Precio</label>
									<div class="input-group">	
										<span class="input-group-addon" id="basic-addon2"><b>$</b></span>
										<input disabled="true" type="numeric" step = "any" class="form-control" id="precio" name="precio">  
									</div>
								</div>
								<div class="col-lg-4">
                                    <div class="form-group">
										<label for="stock">Stock</label>
										<input disabled="true" type="number" step = "any" class="form-control" id="stock" name="stock">  
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
										<label for="cantidad">Cantidad</label>
										<input type="number" step = "any" value=1 class="form-control" id="cantidad" name="cantidad" required onchange="calcular_total();">  
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-lg-4">
                                    <div class="form-group">
										<label for="idforma_de_pago">Forma de pago</label>
										<select id="idforma_de_pago" name="idforma_de_pago" class="form-control" required>
											@foreach ($formas_de_pago as $form)
												<option value=" {{$form->idforma_de_pago}}">{{$form->nombre}} </option>
											@endforeach
										</select>
									</div>
								</div>
                                
								<div class="col-lg-8">
									<div class="form-group">
										<label for="total">Total</label> 
										<div class="input-group">	
											<span class="input-group-addon" id="basic-addon2"><b>$</b></span>
											<input type="numeric" step = "any" class="form-control" name="total" id="total" value="{{old('total')}}" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" align="center">
						<div class="form-group">
							<button id="Guardar" name="Guardar" class="btn btn-primary" >Guardar</button>
							<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
						</div>
					</div>		
					<script>
						$(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);
					</script>
					<script>
						$(document).ready(function(){ 
							$.ajaxSetup({
								headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
							});
                            $(window).keydown(function(e){
                                if(e.keyCode == 13) {
									cantidad=$("#cantidad").val();
									stock=$("#stock").val();
									if(parseInt(cantidad)<=parseInt(stock)){
										precio=$("#precio").val();
										total=cantidad*precio;
										$("#total").val(total);
									} else {
										alert("La cantidad es superior al stock");
									}
								}
                            }); 
                        });
						function calcular_total(){
							cantidad=$("#cantidad").val();
							stock=$("#stock").val();
							if(parseInt(cantidad)<=parseInt(stock)){
								precio=$("#precio").val();
								total=cantidad*precio;
								$("#total").val(total);
							} else {
								alert("La cantidad es superior al stock");
							}
						}
						$("#Guardar").click(function (e){
							e.preventDefault();
							var producto = $('#producto').val();
							var idforma_de_pago = $('#idforma_de_pago').val();
							var cantidad = $('#cantidad').val();
							var total = $('#total').val();
							console.log(producto+","+cantidad+","+total);
							$.ajax({
								type: "post",
								data: {
									producto: producto,
									idforma_de_pago: idforma_de_pago,
									cantidad: cantidad,
									total: total
								}, success: function(msg) {
									//console.log(msg);
									$(location).attr('href',"/venta/create");
								}, fail: function(){
								}
							});
							
							
						});
					</script>
				</div> <!-- end box-body -->
			</div>
	</div>	
@endsection
<script type="text/javascript">
	function cambio_producto_mostrar_precio()
	{
		datos_producto=document.getElementById('producto').value.split('_');
		document.getElementById('precio').value = datos_producto[1];
		document.getElementById('stock').value = datos_producto[2];
		calcular_total();
	}
</script>

