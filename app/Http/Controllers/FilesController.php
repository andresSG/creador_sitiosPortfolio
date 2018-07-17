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
			$this->createLectorProperties($ruteEmpresa);
			$this->writeProperties($ruteEmpresa, $proyectoData, $contactData);
			$files = glob(public_path($ruteEmpresa . '/'));
		} else {
			$this->createLectorProperties($rutePortFolio);
			$this->writeProperties($rutePortFolio, $proyectoData, $contactData);
			$files = glob(public_path($rutePortFolio . '/'));
		}

		//borramos primero el zip si existe
		if (is_file(public_path($ruteOUT . $proyectoData->nombre_proyecto . '.zip'))) {
			unlink(public_path($ruteOUT . $proyectoData->nombre_proyecto . '.zip'));
		}

		//escribimos zip
		\Zipper::make(public_path($ruteOUT . $proyectoData->nombre_proyecto . '.zip'))->add($files)->close();

		// actualizamos numero de exports (por cada generación de ZIP)
		DB::table('proyectos')->where('id', $idProyecto)->update(['n_exports' => $proyectoData->n_exports + 1]);

		return response()->download(public_path($ruteOUT . $proyectoData->nombre_proyecto . '.zip')); //lo enviamos para descargar!!
	}

	private function writeProperties($ruta, $proyectosData, $contactosData) {
		//$fp = fopen("./laravel/andres_t/" . date("Ymd") . $ultimo . ".html", "w+") or die("Unable to open file!");
		$fp = fopen($ruta . "/properties.txt", "w+") or die("Unable to open file!"); //se abre fichero properties
		//columnas
		$colProyectos = DB::getSchemaBuilder()->getColumnListing('proyectos');
		$colContactos = DB::getSchemaBuilder()->getColumnListing('informacion_contactos');

		$contenido = "";
		foreach ($colProyectos as $colProyect) {
			//solo se mostrarán los campos diferentes a updated...etc
			if ($colProyect == "created_at" or $colProyect == "n_exports" or $colProyect == "updated_at" or $colProyect == "tipoProyecto_id" or $colProyect == "id" or $colProyect == "contacto_id" or $colProyect == "creador_id") {
				//nothing
			} else {
				$contenido .= $colProyect . "=" . str_replace("\n", "<br>", $proyectosData->$colProyect) . "\r\n";
			}
		}
		foreach ($colContactos as $colContact) {
			if ($colContact == "created_at" or $colContact == "updated_at" or $colContact == "id_contacto") {
			} else {
				$contenido .= $colContact . "=" . str_replace("\n", "<br>", $proyectosData->$colProyect) . "\r\n";
			}

		}

		fwrite($fp, $contenido);
		fclose($fp);
	}

	private function loadProperties_cookie() {
		//creará un lector para el fichero properties.txt
		//leerá el fichero y cargará los datos en cookies y en el documento podremos leer cada cookie
		$fp = fopen($ruta . "/lectorProperties.php", "w+") or die("Unable to open file!");
		//borraremos all cookies
		$contenido = "<?php function obtainData($" . "clave_obtener){
				$" . "fp = fopen('properties.txt', 'r');
				$" . "propiedades = array();
				$" . "valorDevuelto= '';
				while (!feof($" . "fp)){
				    $" . "linea = fgets($" . "fp);
				    list($" . "clave, $" . "valor) = explode('=', $" . "linea);
				    $" . "propiedades[$" . "clave] = $" . "valor;" .
		//aqui escribiremos los cookies
		"}

			fclose($" . "fp);

			}

			?>";
		fwrite($fp, $contenido);
		fclose($fp);
	}

	private function createLectorProperties($ruta) {
		//creará un lector para el fichero properties.txt
		//se parten las variables y el return porque laravel las interpretaría
		$fp = fopen($ruta . "/lectorProperties.php", "w+") or die("Unable to open file!");
		$contenido = "<?php function obtainData($" . "clave_obtener){
				$" . "fp = fopen('properties.txt', 'r');
				$" . "propiedades = array();
				$" . "valorDevuelto= '';
				while (!feof($" . "fp)){
				    $" . "linea = fgets($" . "fp);
				    list($" . "clave, $" . "valor) = explode('=', $" . "linea);
				    $" . "propiedades[$" . "clave] = $" . "valor;
			    if ($" . "clave == $" . "clave_obtener) {
			    	$" . "valorDevuelto = $" . "valor;
			    }
			}

			fclose($" . "fp);

			re" . "turn $" . "valorDevuelto;
			}

			?>";
		fwrite($fp, $contenido);
		fclose($fp);
	}

}
