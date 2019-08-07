@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 align="center" class="box-tittle">
                        <img src="{{asset('imagenes/globos.png')}}"  height="70px" width="70px">    Cumpleaños de Hoy  
                        <img src="{{asset('imagenes/globos.png')}}"  height="70px" width="70px"></h2>
                </div>             
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover text-center">
                                    @foreach ( $cumpleañerosP as $cumpleañeroP)
                                    <tr>
                                        <td>
                                            <div class="media" align="center">
                                                @if (($cumpleañeroP->foto)!="")
                                                    <div class="media-left">
                                                        <img  name="foto" class="media-object" src="{{asset('imagenes/profesores/'.$cumpleañeroP->foto)}}" style="border:1px solid #b0b8b9;" height="100px" width="110px">
                                                    </div>
                                                @else
                                                    <div class="media-left">
                                                        <img  name="foto" class="media-object" src="{{asset('imagenes/torta3.png')}}" style="border:1px solid #b0b8b9;" height="100px" width="110px">
                                                    </div>
                                                @endif
                                                <div name="datos" class="media-body">
                                                    <br>
                                                    <h4 name="nombre" class="media-heading">{{$cumpleañeroP->profesor}}</h4>
                                                    <h4 name="edad" class="media-heading">{{$cumpleañeroP->edad}} años</h4>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>   
                                    @endforeach
                                    @foreach ( $cumpleañerosA as $cumpleañeroA)
                                    <tr>
                                        <td>
                                            <div class="media" align="center">
                                                @if (($cumpleañeroA->foto)!="")
                                                    <div class="media-left">
                                                        <img  name="foto" class="media-object" src="{{asset('imagenes/profesores/'.$cumpleañeroA->foto)}}" style="border:1px solid #b0b8b9;" height="100px" width="110px">
                                                    </div>
                                                @else
                                                    <div class="media-left">
                                                        <img  name="foto" class="media-object" src="{{asset('imagenes/torta3.png')}}" style="border:1px solid #b0b8b9;" height="100px" width="110px">
                                                    </div>
                                                @endif
                                                <div class="media-body">
                                                    <br>
                                                    <h4 name="nombre" class="media-heading">{{$cumpleañeroA->alumno}}</h4>
                                                    <h4 name="edad" class="media-heading">{{$cumpleañeroA->edad}} años</h4>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>   
                                    @endforeach
                                </table>
                            </div> <!-- end table-responsive -->
                            <div class="row" align="right">
                                <div class="col-md-12">
                                    <!-- <button class="btn btn-info" href="{{ URL::previous() }}">Volver</button> -->
                                    <a  class="btn btn-info" href="{{ URL::previous() }}">Volver</a>
                                </div>
                            </div>
                        </div> <!-- end col-md-12 -->
                    </div> <!-- end row -->
                </div> <!-- end box-body -->
            </div> <!-- end box-success-->
        </div> 
    </div>
    
@endsection