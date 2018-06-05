<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model {
	//
	protected $fillable = ['nombre_proyecto', 'nombre_empresa_marcaPersonal', 'que_hacemos',
		'email_corporativo', 'tipoProyecto_id', 'logo', 'n_exports', 'contacto_id'];
}
