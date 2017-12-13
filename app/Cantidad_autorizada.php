<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Cantidad_autorizada extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'cantidad_autorizada';
  protected $fillable = ['id','transformacion','red_mt','red_bt','casas','apartamentos','zonas','locales','bodegas','puntos_fijos'];
  public $timestamps = false;

  public function autorizadas(){
     return $this->belongsTo('App\Autorizacion');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->id);
      }

      return $data;
  }
}
