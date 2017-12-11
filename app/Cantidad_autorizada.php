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
  protected $fillable = ['id','transformacion','red_mt','red_bt','casas','apartamentos','zonas','locales','puntos_fijos'];
  public $timestamps = false;

  public function autorizadas(){
     return $this->hasMany('App\Autorizacion');
  }
}
