<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosUsuariosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('proyectos_usuarios', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->foreign('id_usuario')->references('id')->on('users');
			$table->integer('id_proyecto')->unsigned();
			$table->foreign('id_proyecto')->references('id')->on('proyectos');
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('proyectos_usuarios');
	}
}
