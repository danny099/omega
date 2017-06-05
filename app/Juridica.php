<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Juridica extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'juridica';

  protected $fillable = ['id','razon_social','nit','nombre_representante','cedula','direccion','telefono','email','departamento_id','municipio'];

  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
  public function departamento(){
    return $this->belongsTo('App\Departamento');
  }

}
