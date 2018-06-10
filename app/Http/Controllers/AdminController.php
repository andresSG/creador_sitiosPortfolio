<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {
	public function getUsers() {

		if (auth()->user()) {
			return view('admin.adminUsers');
		} else {
			return view('auth.login');
		}

	}

	public function getProyects() {
		if (auth()->user()) {
			if (auth()->user()->role == 1) {
				$proyectos = DB::table('proyectos')
					->join('users', 'users.id', '=', 'proyectos.creador_id')
					->join('tipos_proyecto', 'tipos_proyecto.id_tipo', '=', 'proyectos.tipoProyecto_id')
					->select('proyectos.id', 'proyectos.nombre_proyecto', 'proyectos.nombre_empresa_marcaPersonal',
						'proyectos.email_corporativo', 'proyectos.n_exports', 'proyectos.updated_at',
						'tipos_proyecto.tipo_proyecto', 'users.userName', 'proyectos.contacto_id')
					->get();

				return view('admin.adminProyects')->with('proyectos', $proyectos);
			} else {
				view('home');
			}
		} else {
			return view('auth.login');
		}
	}

	public function removeProyectAdmin($id) {
		if (auth()->user()->role == 1) {
			DB::table('informacion_contactos')
				->where('id_contacto', $id)->delete();

			$proyectos = DB::table('proyectos')
				->join('users', 'users.id', '=', 'proyectos.creador_id')
				->join('tipos_proyecto', 'tipos_proyecto.id_tipo', '=', 'proyectos.tipoProyecto_id')
				->select('proyectos.id', 'proyectos.nombre_proyecto', 'proyectos.nombre_empresa_marcaPersonal',
					'proyectos.email_corporativo', 'proyectos.n_exports', 'proyectos.updated_at',
					'tipos_proyecto.tipo_proyecto', 'users.userName', 'proyectos.contacto_id')
				->get(); //obtenemos los datos nuevamente

			return view('admin.adminProyects')->with('success', 'Proyect has been deleted')->with('proyectos', $proyectos); //los recargamos en la vista
		} else {
			return view('home');
		}
	}

	public function makeAdmin($id) {
		if (auth()->user()->role == 1) {
			$usuarioup = User::find($id);
			$usuarioup->role = 1;
			//$usuarioup->update_at = date("Y-m-d H:i:s");
			$usuarioup->save();
			return view('admin.adminUsers')->with('success', 'User is Upgrade to Admin');
		} else {
			return view('home');
		}
	}

	public function noAdmin($id) {
		if (auth()->user()->role == 1) {
			$usuarioup = User::find($id);
			$usuarioup->role = 5;
			//$usuarioup->update_at = date("Y-m-d H:i:s");
			$usuarioup->save();
			return view('admin.adminUsers')->with('success', 'Admin is downgrade to User');
		} else {
			return view('home');
		}
	}

	public function removeUser($id) {
		if (auth()->user()->role == 1) {
			$usuarioDel = User::find($id);
			$usuarioDel->delete();
			return view('admin.adminUsers')->with('success', 'User has been Deleted');
		} else {
			return view('home');
		}
	}
}
