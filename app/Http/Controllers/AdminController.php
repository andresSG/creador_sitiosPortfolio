<?php

namespace App\Http\Controllers;

class AdminController extends Controller {
	public function getUsers() {
		//return "under construcction <br>
		//			<a href='javascript:history.back()'>Go Back</a>";

		if (auth()->user()) {
			return view('admin.adminUsers');
		} else {
			return view('auth.login');
		}

	}

	public funcion makeAdmin(){
		
	}
}
