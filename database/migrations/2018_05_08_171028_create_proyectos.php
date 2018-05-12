<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectos extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('proyectos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nombre_proyecto', 200)->unique();
			$table->string('nombre_empresa_marcaPersonal', 120)->unique();
			$table->string('email_corporativo', 160);
			$table->integer('tipoProyecto_id')->unsigned();
			$table->foreign('tipoProyecto_id')->references('id_tipo')->on('tipos_proyecto');
			$table->integer('n_exports');
			$table->timestamps();
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('proyectos');
	}
}
