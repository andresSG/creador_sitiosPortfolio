<?php

namespace App\Http\Controllers;

class profileUserController extends Controller {
	public function index() {
		$user = auth()->user();

		if ($user = auth()->user()) {
			return view('profile.editarPerfil');
		} else {
			return "Unahutorized, you must be logged <<br>
					<a href='javascript:history.back()'>Go Back</a>";
		}
	}

	public function modify() {
		return view('home');
	}
}
