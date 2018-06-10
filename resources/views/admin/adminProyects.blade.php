@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        	 <div class="card-header">Proyects </div>

            <div class="card-body">
            	@if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                @endif
                <table class='table-bordered table-wrapper badge table table-hover table-info'>
                <thead>
                <tr>
                    <th> Id</th>
                    <th> Nombre</th>
                    <th> Usuario </th>
                    <th> Nombre Marca </th>
                    <th> <i class="fas fa-at"> Email Corporativo</i> </th>
                    <th> Tipo proyecto </th>
                    <th> <i class="far fa-arrow-alt-circle-down"> Numero Exports</i> </th>
                    <th> update_at </th>
                </tr>
                </thead>
                <tbody>
		        	@foreach($proyectos as $proyecto)
                    <tr>
                        <td> {{$proyecto->id}} </td>
                        <td> {{$proyecto->nombre_proyecto}} </td>
                        <td> {{$proyecto->userName}} </td>
                        <td> {{$proyecto->nombre_empresa_marcaPersonal}} </td>
                        <td> {{$proyecto->email_corporativo}} </td>
                        <td> {{$proyecto->tipo_proyecto}} </td>
                        <td> {{$proyecto->n_exports}} </td>
                        <td> {{$proyecto->updated_at}} </td>
                        <td>
                            <form action="{{route ('deleteProyectAdmin', [$proyecto->contacto_id])}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger"
                            onclick="return confirm('¿Desea eliminar este proyecto y sus datos asociados?')" type="submit">Eliminar <i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
		        	@endforeach
                </tbody>
                </table>
                <p class="text-warning">*No se mostrarán, ni se podrán modificar datos sin el consentimiento de los usuarios</p>
        	</div>
    	</div>
	</div>
</div>
@endsection