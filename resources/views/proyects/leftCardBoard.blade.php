@if(Auth::user())
<?php $id_user = Auth::user()->id;?>
<script type="text/javascript" charset="utf-8" >
	function selectAll(boleanss){//funciones para seleccionar los checkbox
		if(boleanss){
			$(".check").attr("checked", "checked");
		}else{
			$(".check").removeAttr("checked");
		}
	}

	function selectTop(){
		if($(".check:checked").length == $(".check").length){
			$('#seleted_all')[0].checked = true;
		}else{
			$('#seleted_all')[0].checked = false;
		}

	}

</script>
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
        	<i class="fas fa-archive"> Proyects Menu - </i>
        	({{$proyectos = DB::table('proyectos')->where('creador_id', $id_user)->count()}})
        	<a href="{{route('newProyect')}}" class="btn btn-success icons-right" role="button"><i class="fas fa-plus-square"> Add </i></a>
        	<button class="btn btn-danger icons-right" type="submit" form="proyectosDel" onclick="return confirm('¿Desea eliminar usuario/s?')" value="submit"><i class='fas fa-trash-alt' > Delete </i></button>
		</div>

        <div class="card-body">
<?php
$proyectos = DB::table('proyectos')->where('creador_id', $id_user)->orderBy('nombre_proyecto', 'desc')->get();
?>
<form action="{{route ('deleteProyect')}}" name="proyectosDel" id="proyectosDel" method="POST">
		<table class='table-wrapper table-bordered badge table table-hover'><thead>
			<tr>
		        <th><b> <i class="fas">Proyecto </i></th>
		        <th> <i class="fas fa-at"> Email Corporativo</i> </th>
		        <th> <input type='checkbox' name='seleted_all' id='seleted_all' value='selected_all' onclick="selectAll(this.checked)"> <i class="fas fa-trash-alt">  all</i> </input></th>
		    	</b>
		    </tr>
		</thead>

		<tbody>
				<!--<input name="_method" type="hidden" value="DELETE">-->
				@foreach ($proyectos as $proyecto)
				<tr>
					<td>
						<a href="{{route('editProyect', $proyecto->id)}}">{{$proyecto->nombre_proyecto}}</a>
	            	</td>
					<td>{{$proyecto->email_corporativo}}</td>
					<td>{{ csrf_field() }}
						<input type='checkbox' class="check" name='del[]' value='{{$proyecto->id}}' onclick="selectTop()">
					</td>
					<td>
						<a href="{{route('generateFiles', [$proyecto->id])}}" class="btn btn-info" role="button"><i class="fas fa-download"> Download </i></a>
					</td>
				</tr>
				@endforeach
		</tbody>
		</table></form>
        </div>
    </div>
</div>
@endif
