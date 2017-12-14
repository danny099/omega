<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Valorcot extends Model implements AuditableContract
{
  use Auditable;
  protected $table = 'valorcot';

  protected $fillable = ['id','detalles','cantidad','valor_uni','valor_total','cotizacion_id','transformacion_id','distribucion_id','pufinal_id'];

  public $timestamps = false;

  public function cotizacion(){
    return $this->hasMany('App\Cotizacion');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->id);
      }

      return $data;
  }
}
