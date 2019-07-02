@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <!-- <div class="col-lg-12"> -->
            <div class="box box-success">
                <div class="box-header with-border">

                

                    <h2 class="box-tittle" align="center">Nueva Actividad</h2>
                </div>

                <div class="box-body">
                    {!!Form::open(array('url'=>'actividad','method'=>'POST','autocomplete'=>'off', 'name'=>'registro'))!!}
                        
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            {!! Field::text('nombre', ['class'=>'form-control', 'placeholder'=>'Nombre...', 'value'=>'old(nombre)'])!!}
                        </div>
                      </div>
                    </div>

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Planes</b></h3>
                                <div class="box-body" align="center" >
                                    <div class="row" id="planes">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group">
                                                    <div class="col-md-3">

                                                        <div class="form-check">
                                                            <input  id="check1" name="check1" type="checkbox" class="form-check-input" onclick="ingresar_precio()">
                                                            <label class="form-check-label" for="materialUnchecked"> 1 clase </label>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-5">
                                                        <div class="input-group">	
                                                                    <span class="input-group-addon" id="basic-addon2"><b>Precio $</b></span>
                                                                    <input type="number" step = "any" class="form-control" id="precio1" name="precio1" disabled="true" required>
                                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> 
                                        <br>
                                        <div class="row">
                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <div class="col-lg-3">
                                                    <div class="form-check">
                                                        <input id="check2" name="check2" type="checkbox" class="form-check-input" onclick="ingresar_precio2()">
                                                        <label class="form-check-label" for="materialUnchecked">8 clases</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                        <div class="input-group">	
                                                                    <span class="input-group-addon" id="basic-addon2"><b>Precio $</b></span>
                                                                    <input type="number" step = "any" class="form-control" id="precio2" name="precio2" disabled="true" required>
                                                                    
                                                        </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div> 
                                        <br>
                                        <div class="row">
                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <div class="col-lg-3"> 
                                                    <div class="form-check">
                                                        <input  id="check3" name="check3" type="checkbox" class="form-check-input" onclick="ingresar_precio3()">
                                                        <label class="form-check-label" for="materialUnchecked">12 clases</label>
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-5">
                                                    <div class="input-group">	
                                                        <span class="input-group-addon" id="basic-addon2"><b>Precio $</b></i></span>
                                                        <input type="number" step = "any" class="form-control" id="precio3" name="precio3" disabled="true" required>
                                                        
                                                    </div>
                                                </div>
                                            </div>	<!-- /form-group -->
                                          </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                
                                                <div class="col-lg-3">
                                                    <div class="form-check">
                                                        <input  id="check4" name="check4" type="checkbox" class="form-check-input" onclick="ingresar_precio4()">
                                                        <label class="form-check-label" for="materialUnchecked">20 clases</label>
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-5">
                                                    <div class="input-group">	
                                                        <span class="input-group-addon" id="basic-addon2"><b>Precio $</b></span>
                                                        <input type="number" step = "any" class="form-control" id="precio4" name="precio4" disabled="true" required>  
                                                    </div>
                                                </div>
                                            </div>	<!-- /form-group -->
                                          </div>
                                        </div>
                                        <br>
                                    </div>        
                                </div> <!-- box-body -->
                            </div> <!-- box-header -->
                        </div> <!-- box -->

                        <div class="row" align="center">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a> 
                            </div>
					    </div>		
                    
                    {!!Form::close()!!}

                </div> <!-- end box-body -->

            </div> <!-- end box -->   
        </div> <!-- end col-lg-12-->
    </div> <!-- end row -->
@endsection
<script type="text/javascript">
    function ingresar_precio(){
        var estadoActual = document.getElementById('precio1')
        estadoActual.disabled = !estadoActual.disabled;
    }
    function ingresar_precio2(){
        var estadoActual = document.getElementById('precio2')
        estadoActual.disabled = !estadoActual.disabled;
    }
    function ingresar_precio3(){
        var estadoActual = document.getElementById('precio3')
        estadoActual.disabled = !estadoActual.disabled;
    }
    function ingresar_precio4(){
        var estadoActual = document.getElementById('precio4')
        estadoActual.disabled = !estadoActual.disabled;
    }
</script>
