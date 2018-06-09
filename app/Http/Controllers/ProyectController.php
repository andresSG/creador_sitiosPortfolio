<?php

namespace App\Http\Controllers;
use App\Informacion_contacto;
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
			'localizacion' => 'max:320',
			'mensaje' => 'max:700',
			'fax' => 'max:150',
			'telefono' => 'min:9|max:11|required',
		]);

		$info_contacto = new Informacion_contacto;
		$info_contacto->localizacion = $request->localizacion;
		$info_contacto->mensaje = $request->mensaje;
		$info_contacto->fax = $request->fax;
		$info_contacto->telefono = $request->telefono;
		$info_contacto->save();

		$proyecto = new Proyecto;
		$proyecto->nombre_empresa_marcaPersonal = $request->nombre_empresa_marcaPersonal;
		$proyecto->nombre_proyecto = $request->nombre_proyecto;
		$proyecto->que_hacemos = $request->que_hacemos;
		$proyecto->email_corporativo = $request->email_corporativo;
		$proyecto->tipoProyecto_id = $_POST['tipo_proyecto'];
		$proyecto->creador_id = auth()->user()->id;
		$proyecto->contacto_id = $info_contacto->id;
		$proyecto->n_exports = 0;
		$proyecto->logo = 'ruta';
		$proyecto->save();

		return back()->with('success', 'Proyect has been created')->with('proyecto', $proyecto)->with('contacto', $info_contacto);
	}

	public function editShow($idProyecto) {
		$proyectEdit = DB::table('proyectos')
			->where('id', $idProyecto)->get()->first();

		$contactoEdit = DB::table('informacion_contactos')
			->where('id_contacto', $proyectEdit->contacto_id)->get();

		return view('proyects.editProyectForm')->with('proyecto', $proyectEdit);
	}

	public function editMake($idProyecto) {
		$proyectEdit = DB::table('proyectos')
			->where('id', $idProyecto)->get()->first();

	}
}
