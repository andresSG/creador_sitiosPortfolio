<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPoyectosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('proyectos', function (Blueprint $table) {
			$table->foreign('tipoProyecto_id')->references('id_tipo')->on('tipos_proyecto');
			$table->foreign('creador_id')->references('id')
				->on('users')->onDelete('cascade');
			$table->foreign('contacto_id')->references('id_contacto')
				->on('informacion_contacto')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('proyectos', function (Blueprint $table) {
			$table->dropForeign('proyectos_tipoproyecto_id_foreign');
			$table->dropForeign('proyectos_contacto_id_foreign');
			$table->dropForeign('proyectos_creador_id_foreign');
		});
	}
}
