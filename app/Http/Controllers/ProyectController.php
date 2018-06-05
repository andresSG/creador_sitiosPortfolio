<?php

namespace App\Http\Controllers;
use App\Proyecto;

class ProyectController extends Controller {
	public function index() {
		return view('proyects.newProyectForm');
	}

	public function create(Request $request) {
		$proyect = $this->validate(request(), [
			'name_proyect' => 'required|string|min:5|max:200|unique:proyectos',
			'empresa_marca' => 'required|string|min:5|max:120|unique:proyectos',
			'actividad' => 'string|max:255',
			'email' => 'required|email|max:160|unique:proyectos',
		]);

		Proyecto::create($proyect);

		return back()->with('success', 'Proyect has been created');
	}
}
