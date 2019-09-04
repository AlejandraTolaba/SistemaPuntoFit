@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
					<h2 align="center" class="box-tittle">Modificar Contraseña</h2>
				</div> <!-- end box-header -->
                {!! Form::open(array('action'=>array('UsuarioController@update',$user->id),'method'=>'patch')) !!}
                {{Form::token()}}
                <div class="box-body">
                    <div class="col-md-10 col-md-offset-1">
                        {!! Field::password('password')!!}

                        {!! Field::password('newpassword')!!}

                        {!! Field::password('newpassword_confirmation')!!}
                    </div>
                </div> <!-- end box-body -->
                <div class="box-footer">
                        <div class="row" align="center">
                            <div class="form-group">
                                <button id="Confirmar" name="Confirmar" class="btn btn-primary" type="submit">Confirmar</button>
                                <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
                            </div>
                        </div>
                </div> <!-- end box-footer -->
                {{Form::close()}}
            </div> <!-- end box-success -->
            
        </div>
    </div>
@endsection