@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-success">
                <div class="box-header"> <!-- style="background-color: #01DFA5;" -->
                    <div class="row" align="right">
                        <div class="col-lg-12">
                            <a href="{{ route('alumno.create') }}"><button class="btn btn-success"><i class="fa fa-user-plus"></i><br> Nuevo alumno</button></a>
                        </div>
                    </div>
                    <br>
                    <div class="row" align="right">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button onclick="location.href = '{{ route('alumno.create') }}'"><i class="fa fa-user-plus"></i><br> Nuevo alumno</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body"> <!-- style="background-color: #01DFA5;" -->
                    <div class="row" align ="right">
                            <div class="col-lg-12">
                                <!-- <div class="form-group has-feedback">
                                    <i class="fa fa-user-plus form-control-feedback"></i><br> -->
                                    <input type ='button' class="btn btn-success"  value = 'Nuevo Alumno' onclick="location.href = '{{ route('alumno.create') }}'"/>
                               <!--  </div> -->
                            </div>
                    </div>

                </div> <!-- end box-body-->

                <div class="box-footer"> <!-- style="background-color: #01DFA5;" -->
                    
                </div> <!-- end box-footer-->
            </div> <!-- end box box-success-->
        </div> <!-- end col-md-6 col-md-offset-2-->
    </div> <!-- end row-->
    @include('asistencia.buscar')
@endsection

