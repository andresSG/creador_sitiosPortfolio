<?php

namespace App\Http\Controllers;
use App\User;

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
			return view('admin.adminProyects')->with('proyectos', $proyectos = DB::table('proyectos')->get());
		} else {
			return view('auth.login');
		}
	}

	public function makeAdmin($id) {
		$usuarioup = User::find($id);
		$usuarioup->role = 1;
		//$usuarioup->update_at = date("Y-m-d H:i:s");
		$usuarioup->save();
		return view('admin.adminUsers')->with('success', 'User is Upgrade to Admin');
	}

	public function noAdmin($id) {
		$usuarioup = User::find($id);
		$usuarioup->role = 5;
		//$usuarioup->update_at = date("Y-m-d H:i:s");
		$usuarioup->save();
		return view('admin.adminUsers')->with('success', 'Admin is downgrade to User');
	}

	public function removeUser($id) {
		$usuarioDel = User::find($id);
		$usuarioDel->delete();
		return view('admin.adminUsers')->with('success', 'User has been Deleted');
	}
}
