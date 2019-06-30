@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <h3>Nueva Actividad</h3>
            {!!Form::open(array('url'=>'actividad','method'=>'POST','autocomplete'=>'off'))!!}
            <div class="form-group">
                {!! Field::text('nombre', ['class'=>'form-control', 'placeholder'=>'Nombre...', 'value'=>'old(nombre)'])!!}

                  <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a> 
                  </div>
                  {!!Form::close()!!}
            </div>
        </div>
    </div>


@endsection