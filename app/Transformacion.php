<?php

namespace App;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Database\Eloquent\Model;


class Transformacion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'transformacion';

  protected $fillable = ['id','descripcion','tipo','nivel_tension','unidad','capacidad','cantidad','tipo_refrigeracion','administrativa_id','cotizacion_id'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Administrativa');
    }

    public function cotizacion(){
      return $this->hasMany('App\Cotizacion');
    }

}
