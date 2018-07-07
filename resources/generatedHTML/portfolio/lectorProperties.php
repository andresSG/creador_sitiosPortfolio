<?php function obtainData($clave_obtener){
				$fp = fopen('properties.txt', 'r');
				$propiedades = array();
				$valorDevuelto= '';
				while (!feof($fp)){
				    $linea = fgets($fp);
				    list($clave, $valor) = split('=', $linea);
				    $propiedades[$clave] = $valor;
			    if ($clave == $clave_obtener) {
			    	$valorDevuelto = $valor;
			    }
			}

			fclose($fp);

			return $valorDevuelto;
			}

			?>