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
                        <td>  </td>
                    </tr>
		        	@endforeach
                </tbody>
                </table>
        	</div>
    	</div>
	</div>
</div>
@endsection