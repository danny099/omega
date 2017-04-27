<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignacion extends Model
{
  protected $table = 'Consignacion';

  protected $fillable = ['id','fecha_pago','valor','observaciones','administrativa_id'];

  public $timestamps = false;

  public function administrativa(){
    return $this->belongsTo('Administrativa', 'administrativa_id');
  }
}
