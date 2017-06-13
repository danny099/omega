<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valorcot extends Model
{
  protected $table = 'valorcot';

  protected $fillable = ['id','detalles','cantidad','valor_uni','valor_total','cotizacion_id'];

  public $timestamps = false;

  public function cotizacion(){
    return $this->hasMany('App\Cotizacion');
  }
}
