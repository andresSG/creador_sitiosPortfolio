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
				<ul>
		        	@foreach($proyectos as $proyecto)
						<li>{{$proyecto->nombre_proyecto}}</li>
		        	@endforeach
	        	</ul>
        	</div>
    	</div>
	</div>
</div>
@endsection