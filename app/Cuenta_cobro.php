<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;
class Cuenta_cobro extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'cuenta_cobro';
  protected $fillable = ['id','porcentaje','valor','fecha_cuenta_cobro','fecha_pago','numero_cuenta_cobro','observaciones','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->numero_cuenta_cobro);
      }

      return $data;
  }
}
