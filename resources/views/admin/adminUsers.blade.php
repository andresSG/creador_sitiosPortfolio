@extends('layouts.app')

@section('content')

@if(Auth::user())

@if(Auth::user()->role == 1)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Admin users</div>

                <div class="card-body">
                	<?php
$usuariosRegistrados = DB::table('users')->get();
?>
	@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
	<table class='table-bordered table-wrapper badge table table-hover table-info'><thead>
			<tr>
	            <th> Id</th>
	            <th> UserName</th>
	            <th> Email </th>
	            <th> Created at </th>
	            <th> Updated at </th>
	            <th> ¿Admin? </th>
	            <th> Edit </th>
	            <th> Delete </th>
	        </tr>
        </thead><tbody>
	@foreach ($usuariosRegistrados as $usuario)
		<tr>
			<td>  {{$usuario->id}} </td>
			<td>  {{$usuario->userName}} </td>
			<td>
				<a href='mailto:{{$usuario->email}}?Subject=Admin%20Contact%20CWS_ANDRES'> {{$usuario->email}} </a>
			</td>
			<td>  {{$usuario->created_at}} </td>
			<td>  {{$usuario->updated_at}} </td>
			@if($usuario->role == 5)
			<td><form action="{{route ('makeAdmin', [$usuario->id])}}" method="post">
            		{{csrf_field()}}
	            	<input name="_method" type="hidden" value="PATCH">
	            	<button class="btn btn-default" onclick="return confirm('¿Desea hacer admin a este usuario?')" type="submit"><i class='fas fa-check-circle'> Do Admin</i></button>
          		</form>
				@else
				<td><form action="{{route ('noAdmin', [$usuario->id])}}" method="post">
            		{{csrf_field()}}
	            	<input name="_method" type="hidden" value="PATCH">
	            	<button class="btn btn-primary" onclick="return confirm('¿Desea quitar el admin a este usuario?')" type="submit"><i class='fas fa-times-circle'> No Admin</i></button>
          		</form>
			@endif
			</td>
			<td>
				<form action="{{route ('modifyUserByAdmin', [$usuario->userName])}}" method="POST">
            		{{csrf_field()}}
	            	<button class="btn btn-warning" >Editar <i class="fa fa-edit"></i></button>
          		</form>
			</td>
			<td>
				<form action="{{route ('deleteUser', [$usuario->id])}}" method="post">
            		{{csrf_field()}}
	            	<input name="_method" type="hidden" value="DELETE">
	            	<button class="btn btn-danger" onclick="return confirm('¿Desea eliminar este usuario?')" type="submit">Eliminar <i class="fas fa-trash-alt"></i></button>
          		</form>
			</td>
		</tr>
	@endforeach
		</tbody>
	</table>

                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endif

@endsection