@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-success">
                <div class="box-header">
                    <h2 class="box-tittle" align="center">Editar planes de {{$actividad->nombre}}</h2>
                </div> <!-- box-header with-border -->
                <div class="box-body">
                    <meta name="_token" content="{!! csrf_token() !!}"/>
                    <div class="box">
                        <div class="box-header" with-border align="left">
                            <h3 class="box-title"><b>     Planes</b></h3>
                            <a href=#><button class="btn btn-success" data-toggle="modal" data-target="#ModalPlan">Agregar Plan</button></a>
                            @include('actividad.plan.create')
                        </div> <!-- box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="idplan">Seleccione un Plan</label>
                                            <select id="plan" name="plan" class="form-control" onchange='mostrar_cantidad();'>
                                                <option value=0 selected> - </option>
                                                @foreach ($planes as $plan)
                                                    <option value="{{$plan->idplan}}_{{$plan->cantidad_clases}}">{{$plan->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div> <!-- col-md-4 -->
                                        <div class="col-md-3">
                                            <div class="input-group">	
                                                <label for="cantidad"> Cantidad de clases</label>
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" disabled= "true"> 
                                            </div>
                                        </div> <!-- col-md-3 -->
                                        <div class="col-md-3">
                                            <label for="precio">Precio</label>
                                            <div class="input-group">	
                                                <span class="input-group-addon" id="basic-addon2"><b>$</b></span>
                                                <input type="number" step = "any" class="form-control" id="precio" name="precio"> 
                                            </div>
                                        </div> <!-- col-md-3 -->
                                        <div class="col-md-1">
                                            <br>
                                            <button type="button" id="btn_add" name="btn_add" class="btn btn-warning"><i class="glyphicon glyphicon-arrow-down"></i></button>
                                        </div> <!-- col-md-1 -->
                                    </div> <!-- form-group -->
                                </div> <!-- col-md-12 -->
                            </div> <!-- row -->
                            <br>
                            <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
                                <table id="planes" name="planes" class="table table-resposive table-bordered table-condensed table-hover text-center">
                                    <thead>
                                        <th>Id</th>
                                        <th>Nombre del plan</th>
                                        <th>Cantidad de clases</th>
                                        <th>Precio</th>
                                        <th>Eliminar</th>
                                    </thead>
                                    <tbody id="plan_actividad"  align="center">
                                        @php ($a = 0)
                                        @foreach($plan_actividad as $pa)
                                            <tr class="selected" id={{$a}}>
                                                <td><input readonly type="hidden" name="idplan[]" value="{{$pa->idplan}}">{{$pa->idplan}}</td>
                                                <td><input type="hidden" name="plan[]" value="{{$pa->plan}}">{{$pa->plan}}</td>
                                                <td><input style="border:none" type="hidden" name="cantidad[]" value="{{$pa->cantidad}}">{{$pa->cantidad}}</td>
                                                <td>$<input style="border:none; width:30%; " type="number" id="precio[]" name="precio[]" value="{{$pa->precio}}"></td>
                                                <td><button id="btn_eliminar" name="btn_eliminar" type="button" class="btn btn-danger" onclick="eliminar({{$a}})">X</button></td>
                                            </tr>
                                        @php ($a++)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- table-resposive -->
                        </div> <!-- box-body -->
                    </div> <!-- box -->
                    <div class="row" align="center">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" id="btn1" name="btn1">Confirmar</button>
                            <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a> 
                        </div>
					</div> <!-- row" align="center -->
                  
                    <script>
                        $(document).ready(function() {
                            $.ajaxSetup({
                                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
                                });
                        });
                        
                        $("#btn1").click(function (e) {
                            e.preventDefault();
                            var nombre = $('#nombre').val();
                            var plan = [];
                            var precio =[];
                            // CAPTURA TODOS LOS td QUE HAY EN LA TABLA
                            //asi como esta tuve que cambiar type de precio que estaba en number por hidden, lo malo es que ahora no se puede editar el precio desde la tabla
                            //$('#planes tr').each(function(){
                            //var tdValue = $(this).children('td').map(function (index, val) { return $(this).text(); }).toArray(); //obtengo un array de la forma (3,8 clases, 8, , X)  no me toma el precio
                            //plan.push(tdValue[0]); //agrego el id del plan, en caso de que el cliente no quiera el id como columna cambiar el value del nombre del plan por idplan
                            //precio.push(tdValue[3]); //agrego el precio
                            //alert(tdValue);
                            //});
                            /*por defecto toma la primera fila de la tabla en donde estan los nombres de la
                            columna, entonces, de cada array que arme elimino el primer elemento */
                            //plan.shift(); //[1,2,3,1,4]
                            //alert(plan);

                            var filas= $('#planes').find("tr");
                            for(i = 0; i < filas.length; i++){
                                var celdas = $(filas[i]).find("td"); 
                                var id_plan= $($(celdas[0]).children("input")[0]).val();
                                var valor_precio= $($(celdas[3]).children("input")[0]).val();
                                plan.push(id_plan); //agrego el id del plan
                                precio.push(valor_precio); //agrego el precio
                            }
                            plan.shift();
                            precio.shift();
                            //alert(plan);
                            //alert(precio);
                            
                            // COMPROBAR QUE NO HAYA PLANES REPETIDOS EN TABLA
                            var plan1=[];
                            var b=true;
                            var i=0;
                            while (b && i<plan.length) {
                                if (plan1.includes(plan[i])===false) {
                                    plan1.push(plan[i]);
                                    i++;
                                } else {
                                    b=false;
                                }  
                            }
                            if (b){
                                $.ajax({
                                    type: "patch",
                                    data: {
                                        plan: plan,
                                        precio: precio
                                    }, success: function (msg) {
                                        $(location).attr('href',"/actividad");
                                    }
                                });

                            } else {
                                alert("Error al modificar actividad, no debe haber planes repetidos");
                            }
                            
                        });

                        $('#btn_add').on('click',function(){
                                actividad_planes();
                            });
                            var cont=2000;
                            function actividad_planes(){
                                datos_plan = document.getElementById('plan').value.split('_');
                                idplan=datos_plan[0];
                                plan=$("#plan option:selected").text();
                                cantidad=$("#cantidad").val();
                                precio=$("#precio").val();
                                if(plan!='-'&& precio!=""){
                                    var fila = '<tr class="select" id="'+cont+'"> <td> <input readonly type="hidden" name="idplan[]" value="'+idplan+'">'+idplan+'</td> <td><input type="hidden" name="plan[]" value="'+plan+'">'+plan+'</td> <td><input style="border:none" type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td> <td>$<input style="border:none; width:30%;" type="number" id="precio[]" name="precio[]" value="'+precio+'"></td> <td><button id="btn_eliminar" name="btn_eliminar" type="button" class="btn btn-danger" onclick="eliminar('+cont+')">X</button></td></tr>';
                                    cont++;
                                    $("#planes").append(fila);
                                    limpiar();
                                }
                                else{
                                    alert("Debe seleccionar un plan");
                                }
                            }
                            function limpiar(){ 
                                $("#plan").val("");
                                $("#cantidad").val("");
                                $("#precio").val(""); 
                            }
                            function eliminar(index){
                                $('#'+index).remove();
                            }

                    </script>
                    
                    <script type="text/javascript">
                        function mostrar_cantidad()
                        {
                            datos_plan=document.getElementById('plan').value.split('_');
                            document.getElementById('cantidad').value = datos_plan[1];
                        }
                        
                    </script>
                </div> <!-- box-body -->
            </div> <!-- box box-success -->
        </div> <!-- col-md-8 col-md-offset-2-->
    </div> <!-- end row -->

@endsection


