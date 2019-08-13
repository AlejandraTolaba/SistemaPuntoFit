@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h2 class="box-tittle" align="center">Asistencias del día</h2>
                </div> <!-- box-header with-border -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="idplan">Seleccione una Actividad</label>
                                <select id="actividad" name="actividad" class="form-control">
                                    <option value=0 selected> - </option>
                                    @foreach ($actividades as $actividad)
                                        <option value="{{$actividad->idactividad}}">{{$actividad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Nombre del Alumno</th>
                                    </thead>
                                    <tbody id="tabla">
                                        @foreach ($asistencias as $act)
                                            <tr>
                                                <td>{{ $act -> alu }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end-div-box-body -->
            </div> <!-- end-div-box-success -->
        </div> <!-- end-div-col-md-8 -->
    </div> <!-- end-div-row -->
@endsection