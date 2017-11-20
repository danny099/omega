<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_administrativa extends Model
{
  protected $table = 'usuario_administrativa';

	protected $fillable = array('id','usuario_id','administrativa_id');

	public $timestamps = false;

	public function usuario()
	{
		return $this->belongsTo('Usuario','usuario_id');
	}

	public function administrativa()
	{
		return $this->belongsTo('Administrativa','administrativa_id');
	}
}
