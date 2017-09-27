<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Arr;

class Factura extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'factura';
  protected $fillable = ['id','num_factura','fecha_factura','valor_factura','iva','valor_total','rete_porcen','retenciones','amortizacion','polizas','retegaran_porcen','retegarantia','valor_pagado','fecha_pago','observaciones','administrativa_id','recuerdame'];
  public $timestamps = false;

  public function transformAudit(array $data)
  {
      if (Arr::has($data, 'auditable_id')) {
          Arr::set($data, 'auditable_id',  $this->num_factura);
      }

      return $data;
  }

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
