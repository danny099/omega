<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignacion extends Model
{
  protected $table = 'consignacion';
  protected $fillable = ['id','fecha_pago','valor','valor_iva','valor_total','observaciones','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
