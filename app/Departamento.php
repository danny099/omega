<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
  protected $table = 'departamento';
  protected $fillable = ['id','nombre'];
  public $timestamps = false;

  public function administrativa(){
    return $this->hasOne('App\Administrativa');
  }
  public function municipio(){
    return $this->belongsTo('App\Municipio');
  }
}
