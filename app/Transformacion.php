<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

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

    public function transformAudit(array $data)
    {
        if (Arr::has($data, 'auditable_id')) {
            Arr::set($data, 'auditable_id',  $this->descripcion);
        }

        return $data;
    }

}
