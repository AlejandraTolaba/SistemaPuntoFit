<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Movimientos</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{asset('/imagenes/pf/logo1.jpg')}}" >
      </div>
      <h1>Reporte de Movimientos</h1>
    </header>
            @if($desde == $hasta)
                <h2 name="titulo" class="box-tittle">Movimientos del {{date("d-m-Y",strtotime($desde))}}</h2>
            @else
                <h2 name="titulo" class="box-tittle">Movimientos desde {{date("d-m-Y",strtotime($desde))}} hasta {{date("d-m-Y",strtotime($hasta))}}</h2>
            @endif
            <main>
                <div>
                    <div class="row totales">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span style="background-color: #F2F4F4;" class="input-group-addon" id="basic-addon2">TOTAL INGRESOS</span>	
                                <input style="background-color: white;" readonly type ="text" name="totalIngreso" value="${{$totalIngreso->totalIngreso}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">	
                                <span style=" background-color: #F2F4F4" class="input-group-addon" id="basic-addon2">TOTAL EGRESOS</span>
                                <input style="background-color: white;" readonly type ="text" name="totalEgreso" value="${{$totalEgreso->totalEgreso}}" class="form-control">	
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">	
                                <span style=" background-color: #F2F4F4" class="input-group-addon" id="basic-addon2">TOTAL CAJA</span>
                                <input style="background-color: white;" readonly type ="text" name="total" value="${{$total}}" class="form-control">	
                            </div>
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <th>Concepto</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Tipo</th>
                        <th>Forma de pago</th>
                        <th>Monto</th>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $mov)
                        <tr>
                            <td>{{ $mov -> concepto }}</td>
                            <td><?php $fecha = new DateTime($mov->fecha); echo $fecha->format('d-m-Y');?></td>
                            <td><?php $hora = new DateTime($mov->hora); echo $hora->format('H:i');?></td>
                            <td>{{ $mov -> tipo }}</td>
                            <td>{{ $mov -> forma }}</td>
                            <td>${{ $mov -> monto }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </main>
    <footer>
    </footer>  
  </body>
</html>