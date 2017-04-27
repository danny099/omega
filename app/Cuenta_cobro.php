<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta_cobro extends Model
{
  protected $table = 'cuenta_cobro';

  protected $fillable = ['id','porcentaje','valor','fecha_cuenta_cobro','fecha_pago','numero_cuenta_cobro','observaciones','administrativa_id'];

  public $timestamps = false;

  public function administrativa(){
    return $this->belongsTo('Administrativa', 'administrativa_id');
  }
}
