<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pu_final extends Model
{
  protected $table = 'pu_final';

  protected $fillable = ['id','descripcion','tipo','unidad','cantidad'];

  public $timestamps = false;

    public function administrativa(){
      return $this->hasMany('App\Pu_final');
    }
}
