@extends('layouts.app')

@section('content')

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
        	<?php $proyectoss = session('Proyects')?>
        	@foreach($proyectoss as $proyecto)
				s
        	@endforeach
        	</div>
    	</div>
	</div>
</div>
@endsection