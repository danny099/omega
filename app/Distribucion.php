<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Distribucion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'distribucion';

  protected $fillable = ['id','descripcion','tipo','nivel_tension','unidad','cantidad','apoyos','cajas','notas','administrativa_id','cotizacion_id'];

  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }

  public function cotizacion(){
    return $this->hasMany('App\Cotizacion');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->descripcion);
      }

      return $data;
  }

}
