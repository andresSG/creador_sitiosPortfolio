@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Proyect</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="post" action="{{url('createProyect')}}">
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="form-group col-md-8">
                            <label for="name_proyect">Proyecto :</label>
                            <input type="text" class="form-control" name="name_proyect">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="form-group col-md-8">
                            <label for="empresa_marca">Nombre Empresa/Marca personal:</label>
                            <input type="text" class="form-control" name="empresa_marca">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                            <div class="form-group col-md-8">
                              <label for="actividad">Indica una Frase sobre tu empresa o actividad:</label>
                              <textarea type="text" class="form-control" rows="3" name="actividad"></textarea>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                            <div class="form-group col-md-8">
                              <label for="email_corp">Email corporativo: </label>
                              <input type="email" class="form-control" name="email_corp">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success" style="margin-left:38px">Create Proyect</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
