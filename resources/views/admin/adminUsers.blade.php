@extends('layouts.app')

@section('content')

@if(Auth::user())

@if(Auth::user()->role == 1)
<script type="text/javascript">
function deseaBorrar(userNameSelected){
	var resp = confirm("¿Desea borrar usuario '"+userNameSelected+"'?");
	if(resp){
		<?php
DB::table('users')->where('userName', '')->delete();

?>{{route('adminPanel')}}
	}
}

function hacerAdmin(userNameSelected){
	var resp = confirm("¿Hacer admin a este usuario '"+userNameSelected+"'?");
	if(resp){
		<?php

DB::table('users')
	->where('userName', '')
	->update(['role' => 1, 'updated_at' => new DateTime()]);
?>

	}
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Admin users</div>

                <div class="card-body">
                	<?php
$usuariosRegistrados = DB::table('users')->get();
?>
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
			<td><a onclick="hacerAdmin('{{ $usuario->userName }}')" href="#">
			@if($usuario->role == 5)
					<i class='fas fa-check-circle'> Do Admin</i>
				@else
					<i class='fas fa-times-circle'> No Admin</i>
			@endif
				</a>
			</td>
			<td>
				<a href="{{ route ('modifyUser',[$usuario->userName])}}"> Editar <i class="fa fa-edit"></i></a>
			</td>
			<td>
				<a onclick="deseaBorrar('{{ $usuario->userName }}')" href="#"> Eliminar <i class="fas fa-trash-alt"></i></a>
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