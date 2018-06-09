<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionContactoTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('informacion_contactos', function (Blueprint $table) {
			$table->increments('id_contacto');
			$table->string('localizacion', 320)->nullable();
			$table->string('mensaje', 700)->nullable();
			$table->string('fax', 150)->nullable();
			$table->integer('telefono');
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
		Schema::dropIfExists('informacion_contactos');
	}
}
