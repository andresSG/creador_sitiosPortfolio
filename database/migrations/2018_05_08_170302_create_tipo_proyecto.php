<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProyecto extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tipos_proyecto', function (Blueprint $table) {
			$table->increments('id_tipo');
			$table->string('tipo_proyecto')->unique();
			$table->string('descripcion', 300);
			$table->timestamp('created_at');
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('tipos_proyecto');
	}
}
