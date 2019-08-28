<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Movimientos</title>
    <style>
        h1{
            /* border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;*/
            color: #5D6975; 
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            vertical-align: middle;
            margin: 20px 0 0 0;

        }
        h2,h3,h4{
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
            border: 1px solid #C1CED9;
            border-left: none;
            border-right: none;
            padding: 6px 5px;
            color: #5D6975;
        }
        table th {
            padding: 6px 5px;
            border: 1px solid #C1CED9;
            color: #5D6975;
            white-space: nowrap;        
            font-weight: normal;
            border-left: none;
            border-right: none;
        }
        .table-bordered {
            color: black;
            border: 1px solid #C1CED9;
        }
        .movements{
            width: 100%;
            color: #5D6975;
            border: 1px solid #C1CED9;
        }
        .img-redonda {
            width:100px;
            height:100px;
            border-radius: 50%;
            vertical-align: middle;
            margin: 0px 0px 20px 0px;
            float: left;
        }
        /* #imagen{
            width:100px;
            height:100px;
            border-radius: 50%;
            background-image:url("./imagenes/pf/logo1.jpg");
            float: left;
        } */
    </style>
  </head>
  <body >
    <header class="clearfix">
        <!--<div id="imagen"></div><img class="img-circle" src="./imagenes/pf/logo1.jpg" id="img" alt="Logo"> <img src="{{asset('/imagenes/pf/logo1.jpg')}}"  class="img-circle" alt="Logo" height="30px" width="30px"> -->
        <!-- <div aling="center"><img class="img-redonda" src="./imagenes/pf/logo1.jpg" id="img" alt="Logo"></div> -->
        <img class="img-redonda" src="./imagenes/pf/logo1.jpg" id="img" alt="Logo">
        <h1> Reporte de Movimientos </h1>
    </header>
            @if($desde == $hasta)
                <h3 name="titulo" class="box-tittle">Movimientos del {{date("d-m-Y",strtotime($desde))}}</h3>
            @else
                <h3 name="titulo" class="box-tittle">Movimientos desde el {{date("d-m-Y",strtotime($desde))}} hasta el {{date("d-m-Y",strtotime($hasta))}}</h3>
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
                <br>
                <div class="col-xs-6 ">
                    <table class="table table-bordered" >
                        <tr style="background-color: #F2F4F4; border: 1px solid #C1CED9;">
                            <th  class="text-center" style="color: #5D6975;"><b> INGRESOS EN CONTADO</b></th>
                            <th  class="text-center" style="color: #5D6975;"><b> EGRESOS EN CONTADO </b></th>
                        </tr>
                        <tr>
                            <td  class="text-center">${{$totalIngreso->totalIngreso}}</td>
                            <td  class="text-center">${{$totalEgreso->totalEgreso}}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="col-xs-6">
                    <table class="table table-bordered">
                        <tr style="background-color: #F2F4F4;">
                            <th  class="text-center" style="color: #5D6975;"><b>TOTAL CONTADO</b></th>
                            <th  class="text-center" style="color: #5D6975;"><b>TOTAL CRÉDITO</b></th>
                            <th  class="text-center" style="color: #5D6975;"><b>TOTAL DÉBITO</b></th>
                            <th  class="text-center" style="color: #5D6975;"><b>TOTAL DÉBITO AUTOMÁTICO</b></th>
                            <th  class="text-center" style="color: #5D6975;"><b>TOTAL</b></th>
                        </tr>
                        <tr>
                            <td  class="text-center">${{$totales->totalContado}}</td>
                            <td  class="text-center">${{$totales->totalCredito}}</td>
                            <td  class="text-center">${{$totales->totalDebito}}</td>
                            <td  class="text-center">${{$totales->totalDebitoAutomatico}}</td>
                            <td  class="text-center" style="background-color: #F2F4F4;">${{$total->total}}</td>
                        </tr>
                    </table>
                </div>
            </main>
    <footer>
    </footer>  
  </body>
</html>