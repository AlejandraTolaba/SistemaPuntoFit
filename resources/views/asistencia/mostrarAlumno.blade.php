@extends('layouts.admin')
@section('contenido')
{!! Form::open(array('url'=>'asistencia', 'method'=>'GET', 'autocomplete'=>'off'))!!}
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
                <div class="box-header">
                    @if (($inscripcionA->foto)!="")
                        <div class="media" align="center">
                            <div class="media-body">
                                <br>
                                <h1 class="media-heading">{{$inscripcionA->nombrecompleto}}</h1>
                            </div>
                            <div class="media-right">
                                <img class="media-object" src="{{asset('imagenes/alumnos/'.$inscripcionA->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                            </div>
                        </div>
                    @else
                        <h1 align="center" class="box-tittle">{{$inscripcionA->nombrecompleto}}</h1>
                    @endif
                    <script>  
                        $(document).ready(function(){ 
                            $(window).keydown(function(e){
                                if(e.keyCode == 13) $(location).attr('href',"/asistencia");
                            }); 
                        });
                    </script>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center" style="background-color: gray;">
                                <h3 style="color:white;">{{ $inscripcionA -> actividad }}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <tr>
                                        <th style="width:50%">Plan</th>
                                        <td>{{ $inscripcionA -> plan }}</td>
                                    </tr>
                        
                                    <tr>
                                        <th>Fecha de Vencimiento</th>
                                        <td> <?php $fv = new DateTime($inscripcionA->fecha_vencimiento_inscripcion); echo $fv->format('d-m-Y');?></td>
                                    </tr>

                                    <tr>
                                        <th class = "success text-success">Clases restantes</th>
                                        <td class = "success text-success"><b>{{ $inscripcionA -> cantidad }}</b></td>
                                    </tr>

                                    <tr>
                                        @if($inscripcionA->saldo>0)
                                            <th class = "danger text-danger">Saldo</th>
                                        @else 
                                            <!-- <th>Saldo</th> -->
                                        @endif
                                    
                                        @if($inscripcionA->saldo>0)
                                            <td class = "danger text-danger"><b>{{'$'.$inscripcionA->saldo}}</b></td>
                                        @else 
                                            <!-- <td>{{ '$'.$inscripcionA -> saldo }}</td> -->
                                        @endif
                                    </tr>
                                </table> 
                            </div><!-- table-responsive -->
                        </div><!-- /.col -->
                  </div> <!-- /.row -->
                </div> <!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <!-- <script>
            $(' div.alert ').not(' .alert-important').delay(3000).fadeOut(350);
        </script> -->
        <!-- <script>
            $(' div.row ').delay(3000).fadeOut(350);
        </script> -->
    </div><!-- /.row -->
    {{Form::close()}}
@endsection

