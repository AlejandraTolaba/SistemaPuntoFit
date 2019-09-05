@extends('layouts.admin')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
			@include('flash::message')
		</div>
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
				<div class="box-header with-border">
					<h2 align="center" class="box-tittle">Nuevo Usuario</h2>
				</div> <!-- end box-header -->
				<div class="box-body">
                    <!-- <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }} -->
                    {!! Form::open(array('url'=>'usuarios','method'=>'POST','autocomplete'=>'off')) !!}
					{{Form::token()}}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Field::text('name',['class'=>'form-control', 'value'=>'old(name)'])!!}
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Field::email('email',['class'=>'form-control','placeholder'=>'ejemplo@gmail.com', 'value'=>'old(name)'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                {!! Field::select('tipoUsuario', ['ADMINISTRADOR'=>'ADMINISTRADOR','EMPLEADO'=>'EMPLEADO'], ['empty'=>''])!!}
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label">Contraseña</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-12 control-label">Confirmar Contraseña</label>
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" align="center">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
