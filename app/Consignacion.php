<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Consignacion extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'consignacion';
  protected $fillable = ['id','fecha_pago','valor','valor_iva','valor_total','observaciones','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
