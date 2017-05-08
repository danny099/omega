<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valor_adicional extends Model
{
  protected $table = 'valor_adicional';
  protected $fillable = ['id','valor','detalle','administrativa_id'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasMany('App\Administrativa');
  }
}
