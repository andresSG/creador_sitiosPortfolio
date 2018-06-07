@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Proyect</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                        </div><br />
                    @endif

                    <form method="post" action="{{route('createProyect')}}">
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="form-group col-md-8">
                            <label for="nombre_proyecto">Proyecto :</label>
                            @if (session('proyecto'))
                                <input type="text" class="form-control" value="{{session('proyecto')->nombre_proyecto}}" name="nombre_proyecto" disabled="disabled">
                            @else
                                <input type="text" class="form-control" value="" name="nombre_proyecto" >
                            @endif
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="form-group col-md-8">
                            <label for="tipo_proyecto">Tipo de proyecto :</label>
                            <?php
$tiposPros = DB::table('tipos_proyecto')->orderBy('nombre_proyecto', 'desc')->get();
?>                              @if (session('proyecto'))
                                <select class="form-control" id="tipo_proyecto" name="tipo_proyecto" disabled="disabled">
                                    @foreach ($tiposPros as $tipo)
                                        @if ($tipo->id_tipo == (session('proyecto')->tipoProyecto_id))
                                            <option value="{{$tipo->id_tipo}}" name="{{$tipo->id_tipo}}" selected >{{$tipo->nombre_proyecto}}</option>
                                        @else
                                            <option value="{{$tipo->id_tipo}}" name="{{$tipo->id_tipo}}")>{{$tipo->nombre_proyecto}}</option>
                                        @endif
                                    @endforeach
                                @else
                                <select class="form-control" id="tipo_proyecto" name="tipo_proyecto">
                                    @foreach ($tiposPros as $tipo)
                                        <option value="{{$tipo->id_tipo}}" name="{{$tipo->id_tipo}}">{{$tipo->nombre_proyecto}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="form-group col-md-8">
                            <label for="nombre_empresa_marcaPersonal">Nombre Empresa/Marca personal:</label>
                            @if (session('proyecto'))
                                <input type="text" class="form-control" value="{{session('proyecto')->nombre_empresa_marcaPersonal}}" name="nombre_empresa_marcaPersonal" disabled="disabled">
                            @else
                                <input type="text" class="form-control" name="nombre_empresa_marcaPersonal">
                            @endif
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                            <div class="form-group col-md-8">
                              <label for="que_hacemos">Indica una Frase sobre tu empresa o actividad:</label>
                              @if (session('proyecto'))
                                <textarea type="text" value="{{session('proyecto')->que_hacemos}}" class="form-control" rows="3" name="que_hacemos" disabled="disabled">{{session('proyecto')->que_hacemos}}</textarea>
                              @else
                                <textarea type="text" class="form-control" rows="3" name="que_hacemos"></textarea>
                              @endif
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                            <div class="form-group col-md-8">
                              <label for="email_corporativo">Email corporativo: </label>
                            @if (session('proyecto'))
                                <input type="email" value="{{session('proyecto')->email_corporativo}}" class="form-control" name="email_corporativo" disabled="disabled">
                            @else
                                <input type="email" class="form-control"  name="email_corporativo" >
                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            @if (session('proyecto'))
                                <a href="{{route('home')}}" class="btn btn-info" style="margin-left:38px">
                                Volver atrás</a>
                            @else
                                <button type="submit" class="btn btn-success" style="margin-left:38px">
                                Create Proyect</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
