@extends ('layouts.admin')
@section ('contenido')
{!! Form::open(array('action'=>array('AsistenciaController@mostrarAsistenciaPorDia'), 'method'=>'POST', 'autocomplete'=>'off'))!!}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle" align="center">Asistencias</h2>
                    <script>
						$(document).ready(function(){
							$('#actividad').change(function(){
								$.get("{{ url('dropdown2')}}",
								{ option: $(this).val() },
								function(data) {
									$('#tabla').empty();
									$.each(data, function(key, element) {
                                        var fila = '<tr class="select"> <td><input type="hidden" name="alumnos[]" value="'+element+'">'+key+'</td></tr>';
										$('#tabla').append(fila)            
									});
								});
							});
						});	
					</script>

                    <script>
						$(document).ready(function(){
							$('#actividad').change(function(){
								$.get("{{ url('dropdown3')}}",
								{ option: $(this).val() },
								function(data) {
									$('#cantidad').empty();
									$.each(data, function(key, element) {
										$('#cantidad').val(element);
									});
								});
							});
						});	
					</script>

                <!-- <script type="text/javascript">
                    function mostrar_cantidad()
                    {
                        datos=document.getElementById('cantidad').value;
                        document.getElementById('cantidad').value = datos;
                    }
                </script> -->

                <script type="text/javascript">
                    function cambiar_fecha()
                    {
                        document.getElementById('fecha').value = "<?php echo date('Y-m-d');?>";
                    }
                </script>

                <script>  
                    $(document).ready(function(){ 
                        $(window).keydown(function(e){
                            if(e.keyCode == 13) $(location).attr('href',"/asistencia/mostrarAsistencias");
                        }); 
                    });
                </script>

                </div> <!-- box-header with-border -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="idplan">Seleccione una Actividad</label>
                                <select id="actividad" name="actividad" class="form-control" onchange='cambiar_fecha();'> <!-- onchange='mostrar_cantidad();' -->
                                    <option value=0 selected> - </option>
                                    @foreach ($actividades as $actividad)
                                        @if ( $id == $actividad->idactividad)
                                            <option value="{{$actividad->idactividad}}" selected>{{$actividad->nombre}}</option>
                                        @else
                                            <option value="{{$actividad->idactividad}}">{{$actividad->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-5">
                                <div class="input-group">
                                    <span style="background-color: #F2F4F4;" class="input-group-addon" id="basic-addon2">FECHA</span>	
                                    <input type ="date" id="fecha" name="fecha" value={{$fecha}} class="form-control" style="width:90%">
                                </div>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary" id="filtrar" name="filtrar"><i class="fa fa-calendar"></i></button>
                        </div>
                        <div class="col-md-6" align="right">
                            <h4 name="cant"> <b>Total: <input type ="number" name="cantidad" id="cantidad" value="{{$cantidad->cant}}" style="border:none; width:30%" readonly></b></h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table id="tabla1" class="display table table-hover" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8">
                                    <thead>
                                        <th>NOMBRE DEL ALUMNO</th>
                                    </thead>
                                    <tbody id="tabla">
                                        @foreach ($asistencias as $asis)
                                            <tr>
                                                <td>{{ $asis -> alu }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div align="center">
						{{$asistencias->render()}}
					</div>
                </div> <!-- end-div-box-body -->
            </div> <!-- end-div-box-success -->
        </div> <!-- end-div-col-md-8 -->
    </div> <!-- end-div-row -->
    {{Form::close()}}
@endsection