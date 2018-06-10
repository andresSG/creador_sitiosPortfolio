<?php

use Illuminate\Database\Seeder;

class rellenaMaestros extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('master')->insert(
			array(
				'key' => 'out_path',
				'value' => '../resources/generatedHTML/',
			)
		);

		DB::table('master')->insert(
			array(
				'key' => 'empresa_path',
				'value' => '../resources/generatedHTML/empresa',
			)
		);

		DB::table('master')->insert(
			array(
				'key' => 'portfolio_path',
				'value' => '../resources/generatedHTML/portfolio',
			)
		);

		$this->command->info('Se han insertado valores predefinidos en master* ');
	}
}
