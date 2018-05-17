<?php

namespace App\Http\Controllers;

class profileUserController extends Controller {
	public function index() {
		return view('profile.editarPerfil');
	}
}
