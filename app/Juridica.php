<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juridica extends Model
{
  protected $table = 'juridica';

  protected $fillable = ['id','razon_social','nit','nombre_representante','cedula','direccion','telefono','email','departamento_id','municipio'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Administrativa');
    }
}
