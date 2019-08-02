
<div class="modal  fade modal-slide-in-right" aria-hidem="true" id="ModalPlan" tabindex="-1" role="dialog" tabindex="-1" aria-labelledby="favoritesModalLabel">
      
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box box-success">
                        <div class="box-header with-border">
                            <h2 class="box-tittle" align="center">Nuevo Plan</h2>
                            
                        </div> <!-- box-header with-border -->
                        <div class="box-body">
                            
                            <meta name="_token" content="{!! csrf_token() !!}"/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" id="idplan1" class="form-control" >
                              
                                            {!! Field::text('nombre', ['class'=>'form-control', 'placeholder'=>'Ingrese nombre de plan', 'id'=>'nombreplan'])!!}
                                        </div> <!-- form-group -->
                                    </div> <!-- col-md-12 -->
                                </div> <!-- primer row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Field::number('cantidad_clases', ['class'=>'form-control', 'id'=>'cantidad_clases'])!!}
                                        </div> <!-- form-group -->
                                    </div> <!-- col-md-12 -->
                                </div> <!-- segundo row -->
                                
                                <div class="row" align="center">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" data-dismiss="modal" id="BtnGuardar" name="BtnGuardar" onclick="setTimeout('agrega()',1500);">Guardar</button>
                                        <a class="btn btn-danger" data-dismiss="modal">Cancelar</a> 
                                    </div>
                                </div> <!-- row" align="center -->
                            
                            </form>
                        </div> <!-- box-body -->
                </div> <!-- box box-success -->
            </div> <!-- modal-content -->
            
        </div> <!-- modal-dialog -->
</div> <!-- modal--->

<script>
    $(document).ready(function() {
        $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });
    });
    $("#BtnGuardar").click(function (e){
      e.preventDefault();
      var nombre = $('#nombreplan').val();
      var cantidad_clases = $('#cantidad_clases').val();
      
      $.ajax({
        type: "post",
        url: "plan/create",
        data: {
            nombre: nombre,
            cantidad_clases: cantidad_clases
        }, success: function(plane) {
            
            $('#idplan1').val(plane);
            }
      });
  });
</script>

<script type="text/javascript">

    function insertaACombo( combo) {
            var pl = document.getElementById('nombreplan').value;
            var cant = document.getElementById('cantidad_clases').value;
            var idp = document.getElementById('idplan1').value;
            if(pl!=" " && cant != 0){
                var valor = idp+'_'+cant;
                
                combo.options[combo.options.length] = new Option(pl,valor,"defaultSelected");
            }
    }

    function agrega() {
            var combo = document.getElementById( "plan" );
            insertaACombo( combo );
    }
</script>