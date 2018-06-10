<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller {
	//
	public function generateFile($idProyecto) {
		//obtenemos las rutas
		$ruteEmpresa = DB::table('master')
			->where('key', 'empresa_path')->get()->first()->value;
		$rutePortFolio = DB::table('master')
			->where('key', 'portfolio_path')->get()->first()->value;
		$ruteOUT = DB::table('master')
			->where('key', 'out_path')->get()->first()->value;
		//obtenemos el proyecto y el contacto
		$proyectoData = DB::table('proyectos')
			->where('id', $idProyecto)->get()->first();

		$contactData = DB::table('informacion_contactos')
			->where('id_contacto', $proyectoData->contacto_id)->get()->first();

		//comprobamos el tipo y obtenemos los ficheros, pasando los datos relativos a las tablas
		//proyectos e informacion_contactos//empresa 1, portfolio 2 -> por ahora a pincho ya lo actualizaré
		if ($proyectoData->tipoProyecto_id == 1) {
			$this->writeProperties($ruteEmpresa, $proyectoData, $contactData);
			$files = glob(public_path($ruteEmpresa . '/*'));
			//return var_dump(glob(public_path($ruteEmpresa . '/*')));exit;
		} else {
			$this->writeProperties($rutePortFolio, $proyectoData, $contactData);
			$files = glob(public_path($rutePortFolio . '/*'));
		}

		//escribimos zip
		\Zipper::make(public_path($ruteOUT . $proyectoData->nombre_proyecto . '.zip'))->add($files)->close();

		// actualizamos numero de exports (por cada generación de ZIP)
		DB::table('proyectos')->where('id', $idProyecto)->update(['n_exports' => $proyectoData->n_exports + 1]);

		return response()->download(public_path($ruteOUT . $proyectoData->nombre_proyecto . '.zip')); //lo enviamos para descargar!!
	}

	private function writeProperties($ruta, $proyectosData, $contactosData) {
		//$fp = fopen("./laravel/andres_t/" . date("Ymd") . $ultimo . ".html", "w+") or die("Unable to open file!");
		$fp = fopen($ruta . "/properties.txt", "w+") or die("Unable to open file!");
		//columnas
		$colProyectos = DB::getSchemaBuilder()->getColumnListing('proyectos');
		$colContactos = DB::getSchemaBuilder()->getColumnListing('informacion_contactos');

		$contenido = "";
		foreach ($colProyectos as $colProyect) {
			if ($colProyect == "created_at" or $colProyect == "updated_at" or $colProyect == "tipoProyecto_id") {
				//nothing
			} else {
				$contenido .= $colProyect . "=" . $proyectosData->$colProyect . ";" . "\r\n";
			}
		}
		foreach ($colContactos as $colContact) {
			if ($colProyect == "created_at" or $colProyect == "updated_at" or $colProyect == "tipoProyecto_id") {
			} else {
				$contenido .= $colContact . "=" . $contactosData->$colContact . ";";
			}

		}

		//echo $fp;
		fwrite($fp, $contenido);
		fclose($fp);
	}

}
