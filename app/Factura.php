<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
  protected $table = 'factura';
  protected $fillable = ['id','num_factura','fecha_factura','valor_factura','iva','retenciones','amortizacion','fecha_pago','observaciones','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
