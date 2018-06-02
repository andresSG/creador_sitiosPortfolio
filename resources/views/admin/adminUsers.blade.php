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
?>
	}
}

function hacerAdmin(userNameSelected){
	var resp = confirm("¿Hacer admin a este usuario '"+userNameSelected+"'?");
	if(resp){
		<?php

DB::table('users')
	->where('userName', 'asg52')
	->update(['role' => 1]);
?>

	}
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Admin users</div>

                <div class="card-body">
                	<?php
$usuariosRegistrados = DB::table('users')->get();
print "<table class='table-bordered table-wrapper badge table table-hover table-info'><thead>
		<tr>
            </b><th> Id</th>
            <th> UserName</th>
            <th> Email </th>
            <th> Created at </th>
            <th> Updated at </th>
            <th> ¿Admin? </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
        </thead><tbody>";
foreach ($usuariosRegistrados as $usuario) {
	print "<tr><td>" . $usuario->id . "</td><td> " . $usuario->userName . "</td>";
	print "<td><a href='mailto:" . $usuario->email . "?Subject=Admin%20Contact%20CWS_ANDRES'>" . $usuario->email .
	"</a></td><td> " . $usuario->created_at . "</td><td> " . $usuario->updated_at . "</td>";
	?>
	<td><a onclick="hacerAdmin('{{ $usuario->userName }}')" href="#">
	<?php
if ($usuario->role == 5) {
		print "<i class='fas fa-check-circle'> Admin</i>";
	} else {
		print "<i class='fas fa-times-circle'> No Admin</i>";
	}
	?>
	</a></td>
	<td><a href="{{ route ('modifyUser',[$usuario->userName])}}"> Editar <i class="fa fa-edit"></i></a></td>
	<td><a onclick="deseaBorrar('{{ $usuario->userName }}')" href="#"> Eliminar <i class="fas fa-trash-alt"></i></a></td>
	</tr>
<?php
}
print "</table>";
?>

                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endif

@endsection