@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 align="center" class="box-tittle">Hoy es el cumpleaños de </h2>
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
                                                <div class="media-left">
                                                    <img  name="Foto" class="media-object" src="{{asset('imagenes/profesores/'.$cumpleañeroP->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                                                </div>
                                                <div class="media-body">
                                                    <br>
                                                    <h4 name="Nombre" class="media-heading">{{$cumpleañeroP->profesor}}</h4>
                                                    <h4 name="Edad" class="media-heading">{{$cumpleañeroP->edad}} años</h4>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>   
                                    @endforeach
                                    @foreach ( $cumpleañerosA as $cumpleañeroA)
                                    <tr>
                                        <td>
                                            <div class="media" align="center">
                                                <div class="media-left">
                                                    <img  name="Foto" class="media-object" src="{{asset('imagenes/alumnos/'.$cumpleañeroA->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                                                </div>
                                                <div class="media-body">
                                                    <br>
                                                    <h4 name="Nombre" class="media-heading">{{$cumpleañeroA->alumno}}</h4>
                                                    <h4 name="Edad" class="media-heading">{{$cumpleañeroA->edad}} años</h4>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>   
                                    @endforeach
                                </table>
                            </div> <!-- end table-responsive -->
                        </div> <!-- end col-md-12 -->
                    </div> <!-- end row -->
                </div> <!-- end box-body -->
            </div> <!-- end box-success-->
        </div> 
    </div>
    
@endsection