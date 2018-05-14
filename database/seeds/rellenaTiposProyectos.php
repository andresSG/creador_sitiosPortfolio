<?php

use Illuminate\Database\Seeder;

class rellenaTiposProyectos extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('tipos_proyecto')->insert(
			array(
				'nombre_proyecto' => 'Empresa',
				'descripcion' => 'Dedicado a proyectos empresariales o sociedades',
			)
		);

		DB::table('tipos_proyecto')->insert(
			array(
				'nombre_proyecto' => 'Portfolio',
				'descripcion' => 'Proyectos de marca personal, o en solitario',
			)
		);

		$this->command->info('Se han insertado valores predefinidos en tipos_proyecto* ');
	}
}
