<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transformacion extends Model
{
  protected $table = 'transformacion';

  protected $fillable = ['id','descripcion','tipo','capacidad','unidad','cantidad'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Transformacion');
    }

}
