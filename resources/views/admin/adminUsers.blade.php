@extends('layouts.app')

@section('content')
<script type="text/javascript">
function deseaBorrar(userNameSelected){
	var resp = confirm("¿Desea borrar este usuario?");
	if(resp){
		//alert(userNameSelected);

	}
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin users</div>

                <div class="card-body">
                	<?php
$usuariosRegistrados = DB::table('users')->get();
print "<table border='1'><thead>
		<tr>
            <th> id</th>
            <th> userName</th>
            <th> email </th>
            <th> created at </th>
            <th> updated at </th>
            <th> edit</th>
            <th> delete</th>
        </tr>
        </thead><tbody>";
foreach ($usuariosRegistrados as $usuario) {
	print "<tr><td>" . $usuario->id . "</td><td> " . $usuario->userName . "</td>";
	print "<td><a href='mailto:" . $usuario->email . "'?Subject=Admin%20Contact%20CWS_ANDRES>" . $usuario->email .
	"</a></td><td> " . $usuario->created_at . "</td><td> " . $usuario->updated_at . "</td>";
	?>
	<td><a href=" {{ url('/profile/'.$usuario->userName) }} "> Editar <i class="fa fa-edit"></i></a></td>
	<td><a onclick="deseaBorrar(<?php $usuario->userName?>)" href="#"> Eliminar <i class="fas fa-trash-alt"></i></a></td>
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

@endsection