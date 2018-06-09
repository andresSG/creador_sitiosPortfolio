<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion_contacto extends Model {
	//
	protected $fillable = ['localizacion', 'mensaje', 'fax', 'telefono'];
}
