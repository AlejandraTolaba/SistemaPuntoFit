<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Movimientos</title>
    <style>
        h1{
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }
        h2,h3{
            color: #5D6975;
            font-weight: normal;
            text-align: left;
        }
        header {
            padding: 5px 0;
            margin-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
        }
        table th,
        table td {
            text-align: center;
            white-space: nowrap;        
            font-weight: normal;
        }
        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
        }
        .table-bordered th{
            color: black;
        }
        .movements{
            margin-left: 210px;
        }
    </style>
  </head>
  <body >
    <header class="clearfix">
      <h1>Reporte de Movimientos</h1>
    </header>
            @if($desde == $hasta)
                <h2 name="titulo" class="box-tittle">Movimientos del {{date("d-m-Y",strtotime($desde))}}</h2>
            @else
                <h2 name="titulo" class="box-tittle">Movimientos desde {{date("d-m-Y",strtotime($desde))}} hasta {{date("d-m-Y",strtotime($hasta))}}</h2>
            @endif
            <main>
                <table style="border-bottom:2px;">
                    <tr style="background-color: #F2F4F4;">
                        <th>Concepto</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Tipo</th>
                        <th>Forma de pago</th>
                        <th>Monto</th>
                    </tr> 
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
                <div class="col-xs-6 movements">
                    <table class="table table-bordered" style="width: 150px">
                        <tr style="background-color: #F2F4F4;">
                            <th  class="text-center">TOTAL INGRESOS</th>
                            <th  class="text-center">TOTAL EGRESOS</th>
                            <th  class="text-center">TOTAL CAJA</th>
                        </tr>
                        <tr>
                            <td  class="text-center">${{$totalIngreso->totalIngreso}}</td>
                            <td  class="text-center">${{$totalEgreso->totalEgreso}}</td>
                            <td  class="text-center">${{$total}}</td>   
                        </tr>
                    </table>
    </div>
            </main>
    <footer>
    </footer>  
  </body>
</html>