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
			'fax' => 'numeric|max:99999999999',
			'telefono' => 'min:999999999|max:99999999999|numeric|required',
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

		$contactEdit = DB::table('informacion_contactos')
			->where('id_contacto', $proyectEdit->contacto_id)->get()->first();

		return view('proyects.editProyectForm')->with('proyecto', $proyectEdit)->with('contacto', $contactEdit);
	}

	public function editMake(Request $request, $idProyecto_e) {
		//validacion input
		$proyect = $this->validate(request(), [
			'que_hacemos' => 'string|max:255',
			'localizacion' => 'max:320',
			'mensaje' => 'max:700',
			'fax' => 'numeric|max:99999999999',
			'telefono' => 'min:999999999|max:99999999999|numeric|required',
		]);

		$proyectEdit = DB::table('proyectos')
			->where('id', $idProyecto_e)->get()->first();

		$contactEdit = DB::table('informacion_contactos')
			->where('id_contacto', $proyectEdit->contacto_id)->get()->first();

		if (($user = auth()->user())->id == $proyectEdit->creador_id) {
			if (isset($request["nombre_proyecto"]) && ($proyectEdit->nombre_proyecto != $request["nombre_proyecto"])) {
				DB::table('proyectos')
					->where('id', $proyectEdit->id)
					->update(['nombre_proyecto' => $request["nombre_proyecto"]]);
			}
			if (isset($request["tipo_proyecto"]) && ($proyectEdit->tipoProyecto_id != $request["tipo_proyecto"])) {
				DB::table('proyectos')
					->where('id', $proyectEdit->id)
					->update(['tipoProyecto_id' => $request["tipo_proyecto"]]);
			}
			if (isset($request["nombre_empresa_marcaPersonal"]) && ($proyectEdit->nombre_empresa_marcaPersonal != $request["nombre_empresa_marcaPersonal"])) {
				DB::table('proyectos')
					->where('id', $proyectEdit->id)
					->update(['nombre_empresa_marcaPersonal' => $request["nombre_empresa_marcaPersonal"]]);
			}
			if (isset($request["que_hacemos"]) && ($proyectEdit->que_hacemos != $request["que_hacemos"])) {
				DB::table('proyectos')
					->where('id', $proyectEdit->id)
					->update(['que_hacemos' => $request["que_hacemos"]]);
			}
			if (isset($request["email_corporativo"]) && ($proyectEdit->email_corporativo != $request["email_corporativo"])) {
				DB::table('proyectos')
					->where('id', $proyectEdit->id)
					->update(['email_corporativo' => $request["email_corporativo"]]);
			}

			if (isset($request["localizacion"]) && ($contactEdit->localizacion != $request["localizacion"])) {
				DB::table('informacion_contactos')
					->where('id_contacto', $contactEdit->id_contacto)
					->update(['localizacion' => $request["localizacion"]]);
			}
			if (isset($request["fax"]) && ($contactEdit->fax != $request["fax"])) {
				DB::table('informacion_contactos')
					->where('id_contacto', $contactEdit->id_contacto)
					->update(['fax' => $request["fax"]]);
			}
			if (isset($request["mensaje"]) && ($contactEdit->mensaje != $request["mensaje"])) {
				DB::table('informacion_contactos')
					->where('id_contacto', $contactEdit->id_contacto)
					->update(['mensaje' => $request["mensaje"]]);
			}
			if (isset($request["telefono"]) && ($contactEdit->telefono != $request["telefono"])) {
				DB::table('informacion_contactos')
					->where('id_contacto', $contactEdit->id_contacto)
					->update(['telefono' => $request["telefono"]]);
			}

			$proyectEdit = DB::table('proyectos')
				->where('id', $idProyecto_e)->get()->first();
			$contactEdit = DB::table('informacion_contactos')
				->where('id_contacto', $proyectEdit->contacto_id)->get()->first();
			//recargamos el proyecto y la info de cintacto antes de mostrar el formulario y sus datos

			return back()->with('success', 'Modify proyecto web OK')
				->with('proyecto', $proyectEdit)->with('contacto', $contactEdit);
		} else {
			return "No puedes editar datos de otros usuarios <br>
					<a href='javascript:history.back()'>Go Back</a>";
		}

	}

	public function deleteProyect(Request $request) {

		if (isset($_POST['del'])) {

			foreach ($_POST['del'] as $option) {
				$proyectoDel = DB::table('proyectos')
					->where('id', $option)->get()->first(); //obtenemos proyecto
				$infoDel = DB::table('informacion_contactos')
					->where('id_contacto', $proyectoDel->contacto_id)->delete(); //obtenemos contacto y
				//borramos contacto y se borra el proyecto asociado (on delete cascade)

				$ruteOUT = DB::table('master') //borramos el zip si existe generado
					->where('key', 'out_path')->get()->first()->value;
				if (is_file(public_path($ruteOUT . $proyectoDel->nombre_proyecto . '.zip'))) {
					unlink(public_path($ruteOUT . $proyectoDel->nombre_proyecto . '.zip'));
				}
			}

			return view('home')->with('success', 'Proyect has been Deleted');
		} else {
			return view('home')->with('error', 'Select a proyect to delete');
		}
	}
}
