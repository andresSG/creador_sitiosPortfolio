<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller {
	//
	public function generateFile() {
		//obtenemos las rutas
		$ruteEmpresa = DB::table('master')
				->where('key', 'empresa_path')->get()->first()->value;
		$rutePortFolio = DB::table('master')
				->where('key', 'portfolio_path')->get()->first()->value;
		$ruteOUT = DB::table('master')
				->where('key', 'out_path')->get()->first()->value;

		if($empresa){//comprobamos el tipo y obtenemos los ficheros
			writeProperties($ruteEmpresa);
			$files = glob(public_path($ruteEmpresa.'/*'));
		}else{
			writeProperties($rutePortFolio);
			$files = glob(public_path($rutePortFolio.'/*'));
		}

		//escribimos zip
        \Zipper::make(public_path($ruteOUT.'test.zip'))->add($files)->close();

        return response()->download(public_path($ruteOUT.'test.zip'));//lo enviamos para descargar!!
	}

	private function writeProperties($ruta){
		//$fp = fopen("./laravel/andres_t/" . date("Ymd") . $ultimo . ".html", "w+") or die("Unable to open file!");
		$fp = fopen($ruta."properties.txt", "w+") or die("Unable to open file!");
		$contenido = 
		;
		echo $fp;
		fwrite($fp, $contenido);
		fclose($fp);
	}
}
