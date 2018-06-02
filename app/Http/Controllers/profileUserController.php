<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class profileUserController extends Controller {
	public function index($user) {
		$activeUser = auth()->user();

		if (isset($activeUser) && !is_null($activeUser)) {
			$editUser = DB::table('users')
				->where('username', $user)->get()->first();

			if (isset($editUser) && !is_null($editUser)) {
				return view('profile.editarPerfil')->with('user', $editUser);
			} else {
				return "No se encuentra el usuario en BD, o acaba de ser eliminado<br>
					<a href='javascript:history.back()'>Go Back</a>";
			}
		} else {
			return "Unahutorized, you must be logged <br>
					<a href='javascript:history.back()'>Go Back</a>";
		}
	}

	public function modify(Request $request) {
		$datosForm = $request;

		if ($user = auth()->user() && auth()->user()->role == 1) {

			$editUser = DB::table('users')
				->where('userName', $datosForm["userNam"])->get()->first();

			if (!is_null($editUser)) {
//
				if (isset($datosForm["name"]) && ($editUser->name != $datosForm["name"])) {
					DB::table('users')
						->where('id', $editUser->id)
						->update(['name' => $datosForm["name"]]);
				}
				if (isset($datosForm["email"]) && ($editUser->email != $datosForm["email"])) {
					DB::table('users')
						->where('id', $editUser->id)
						->update(['email' => $datosForm["email"]]);
				}
				if (isset($datosForm["birth"])) {
					DB::table('users')
						->where('id', $editUser->id)
						->update(['birth' => $datosForm["birth"]]);
				}
				if (isset($datosForm["password"]) && isset($datosForm["password-confirm"])) {
					if ($datosForm["password"] == $datosForm["password-confirm"]) {
						DB::table('users')
							->where('id', $editUser->id)
							->update(['password' => md5($datosForm["password"])]);
					} else {
						//las contraseñas no coinciden
					}
				}

			} else {
				return "No se encuentra el usuario en BD, o acaba de ser eliminado<br>
					<a href='javascript:history.back()'>Go Back</a>";
			}

			$editUser = DB::table('users')
				->where('userName', $datosForm["userNam"])->get()->first();
			//recargamos el usuario antes de mostrar el formulario y sus datos

			return view('profile.editarPerfil')->with('user', $editUser);
		} else {
			return "Unahutorized, you must be logged <br>
					<a href='javascript:history.back()'>Go Back</a>";
		}
	}
}
