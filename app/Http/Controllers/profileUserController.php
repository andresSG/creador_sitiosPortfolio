<?php

namespace App\Http\Controllers;

class profileUserController extends Controller {
	public function index() {

		//if (true) {
		//	return ('>_' . 'holla');
		//}

		return view('profile.editarPerfil');

	}

	public function modify() {
		return view('home');
	}
}
