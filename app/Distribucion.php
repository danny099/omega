<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
  protected $table = 'distribucion';

    protected $fillable = ['id','descripcion','tipo','capacidad','unidad','cantidad'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Distribucion');
    }
}
