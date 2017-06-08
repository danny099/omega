<?php

namespace App;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Database\Eloquent\Model;


class Transformacion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'transformacion';

  protected $fillable = ['id','descripcion','tipo','capacidad','unidad','cantidad','potencia','tipo_refrigeracion','administrativa_id'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Administrativa');
    }

    public function cotizacion(){
      return $this->hasMany('App\Cotizacion');
    }

}
