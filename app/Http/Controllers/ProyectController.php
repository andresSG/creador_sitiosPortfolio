<?php

namespace App\Http\Controllers;
use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectController extends Controller {
	public function index() {

		if (auth()->user()) {
			return view('proyects.newProyectForm');
		} else {
			return view('auth.login');
		}

	}

	public function create(Request $request) {
		$proyect = $this->validate(request(), [
			'nombre_proyecto' => 'required|string|min:5|max:200|unique:proyectos',
			'nombre_empresa_marcaPersonal' => 'required|string|min:5|max:120|unique:proyectos',
			'que_hacemos' => 'string|max:255',
			'email_corporativo' => 'required|email|max:160|unique:proyectos',
		]);

		$proyecto = new Proyecto;
		$proyecto->nombre_empresa_marcaPersonal = $request->nombre_empresa_marcaPersonal;
		$proyecto->nombre_proyecto = $request->nombre_proyecto;
		$proyecto->que_hacemos = $request->que_hacemos;
		$proyecto->email_corporativo = $request->email_corporativo;
		$proyecto->tipoProyecto_id = $_POST['tipo_proyecto'];
		$proyecto->creador_id = auth()->user()->id;
		$proyecto->contacto_id = 1;
		$proyecto->n_exports = 0;
		$proyecto->logo = 'ruta';
		$proyecto->save();

		$proyecto = DB::table('proyectos')
			->where('nombre_proyecto', $request->nombre_proyecto)->get()->first();

		return back()->with('success', 'Proyect has been created')->with('proyecto', $proyecto);
	}
}
