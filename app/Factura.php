<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
  protected $table = 'factura';
  protected $fillable = ['id','num_factura','fecha_factura','valor_factura','iva','valor_total','rete_porcen','retenciones','amortizacion','polizas','retegaran_porcen','retegarantia','valor_pagado','fecha_pago','observaciones','administrativa_id','recuerdame'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
